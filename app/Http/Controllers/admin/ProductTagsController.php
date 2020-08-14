<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductTags;

class ProductTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = ProductTags::all();
        return view('admin.product_tag.index')->with(['tags' => $tags]);
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
        $data = $request->all();
            
        $id = isset($data['id']) ? $data['id'] : '0';    
        $name = $data['name'];
        $description = ($data['description']) ? $data['description'] : '';
        $slug = $data['slug'];
        if(trim($slug) == ''){
            $slug = $this->slugify($name);
        }else{
            $slug = $this->slugify($slug);
        }
    
        $dataInsert = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $id = ProductTags::insertGetId($dataInsert);
       
        if($id){
            $tag = ProductTags::find($id)->toArray();
            echo json_encode($tag);
        }else{
            echo 0;
        }
    }

    public function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
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
    public function update(Request $request)
    {
        $data = $request->all();

        $id = isset($data['id']) ? $data['id'] : '0';    
        $name = $data['name'];
        $description = ($data['description']) ? $data['description'] : '';
        $slug = $data['slug'];
        if(trim($slug) == ''){
            $slug = $this->slugify($name);
        }else{
            $slug = $this->slugify($slug);
        }

        $tag = ProductTags::find($id);
        $tag->name = $name;
        $tag->description = $description;
        $tag->slug = $slug;

        $result = $tag->save();
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        
        $ids = $data['ids'];
        if(is_array(($ids))){
            $result = ProductTags::destroy($ids);
            if($result){
                echo 1;
                die;
            }
        }
        echo 0;
    }
}
