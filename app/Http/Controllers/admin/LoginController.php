<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\Hash;
use Lang;

class LoginController extends Controller{
	
    public function login(){
    	// Hash::make('123456');
    	if(Auth::check()){
    		return redirect("/admin");
    	}
    	return view('admin.login');
    }


    public function postLogin(Request $request){

    	$remember_token = ($request->has('remember_token')) ? true : false; 
		$email = $request->input('email');
        $password = $request->input('password');
        $credential = [
            'email'     => $email,
            'password'  => $password,
            //'status' => 1
        ];
	
		$auth = Auth::attempt($credential, $remember_token);
		if($auth){
			$user = Auth::user();
				
			if(!$user->status){
				return redirect()->back()->with('error', Lang::get('auth.blocked') );
			}
			if($user->isSupperAdmin()){
				return redirect()->intended(route('admin.index'));
			}else{
				return redirect('/');
			}
		}else{
			return redirect()->back()->with('error', Lang::get('auth.failed'));
		}
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
