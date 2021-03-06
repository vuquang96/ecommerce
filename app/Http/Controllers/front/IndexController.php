<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Slide;
use App\Category;
use App\Products;

use Mail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listSlide = Slide::where('status', '1')->first()->toArray();
        $categories = Category::where('status', '1')->limit(3)->get()->toArray();
                
        foreach ($categories as $key => $item) {
            $categories[$key]['total_product'] = Products::where('category', $item['id'])->where('status', 1)->count();
        }

        $listProductPopular = Products::where('is_popular', 1)->where('status', 1)->skip(0)->take(8)->get()->toArray();
            
      

        $dataView = [
                'listSlide' => $listSlide, 
                'categories' => $categories,
                'listProductPopular' => $listProductPopular,
            ];
        return view('front.home')->with($dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendMail(){
        $to_name = 'VuQuang';
        $to_email = 'quang96s2@gmail.com';
        $data = array('name' => 'VQuang', 'body' => 'A test mail');
        Mail::send('email.email', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
                ->subject('Laravel Test Mail');
                $message->from('vqvuquang@gmail.com', 'Test Mail');
        });
    }
}
