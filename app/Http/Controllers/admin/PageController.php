<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all()->toArray();
        return view('admin.page.index')->with(['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);


        $data = $request->all();

        $name = isset($data['name']) ? $data['name'] : '';
        $content = isset($data['content']) ? $data['content'] : '';
        $slug = isset($data['slug']) ? $data['slug'] : '';
        $status = isset($data['status']) ? $data['status'] : '0';

        $dataInsert = [
            'name' => $name,
            'content' => $content,
            'slug' => $slug,
            'status' => $status
        ];

        $result = Page::create($dataInsert);

        if($result){
            return redirect(route('admin.page'))->with('success', 'Page creation success');
        }else{
            return redirect()->back()->with('error', 'An error occurred, please try again');
        }
            
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
        $page = Page::find($id)->toArray();
        return view('admin.page.edit')->with(['page'=>$page]);
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
        $request->validate([
            'name' => 'required'
        ]);

        $data = $request->all();
        $page = Page::find($id);
        $page->name = isset($data['name']) ? $data['name'] : '';
        $page->content = isset($data['content']) ? $data['content'] : '';
        $page->slug = isset($data['slug']) ? $data['slug'] : '';
        $page->status = isset($data['status']) ? $data['status'] : '0';

        $result = $page->save();

        if($result){
            return redirect(route('admin.page'))->with('success', 'update successful');
        }else{
            return redirect()->back()->with('error', 'An error occurred, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Page::destroy($id);
        if($result){
            return redirect(route('admin.page'))->with('success', 'deleted successfully');
        }
        return redirect(route('admin.page'))->with('error', 'An error occurred, please try again');
        
    }
        
}
