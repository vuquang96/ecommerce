<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductAttributes;

class ProductAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttributes::whereNull('type')->whereNull('parent_id')->get();
        return view('admin.product_attributes.index')->with('attributes', $attributes);
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
        $name = isset($data['name']) ? $data['name'] : '';
        $slug = isset($data['slug']) ? $data['slug'] : '';
        $description = isset($data['description']) ? $data['description'] : '';
        $parent_id = isset($data['parent_id']) ? $data['parent_id'] : null;
        $type = isset($data['type']) ? $data['type'] : '';
        $order = isset($data['order']) ? $data['order'] : '0';

        if(trim($slug) != ''){
            $slug = slugify($slug);
        }else{
            $slug = slugify($name);
        }
        $dataInsert = [];
        $dataInsert['name'] = $name;
        $dataInsert['slug'] = $slug;
        $dataInsert['order'] = $order;
        $dataInsert['description'] = $description;
        $dataInsert['parent_id'] = $parent_id;
        $dataInsert['type'] = $type;
        $dataInsert['created_at'] = date('Y-m-d H:i:s');
        $dataInsert['updated_at'] = date('Y-m-d H:i:s');

        $id = ProductAttributes::insertGetId($dataInsert);
        if($id){
            $attr = ProductAttributes::find($id)->toArray();
            echo json_encode($attr);
        }else{
            echo 0;
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
        $terms = ProductAttributes::where('type', '1')->where('parent_id', $id)->get();

        $data = [
            'terms' => $terms,
            'parent_id' => $id,
        ];
        return view('admin.product_attributes.detail')->with($data);
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
        $id = isset($data['id']) ? $data['id'] : '';
        if($id){
            $attr = ProductAttributes::find($id);
            $name = isset($data['name']) ? $data['name'] : '';
            $slug = isset($data['slug']) ? $data['slug'] : '';
            $order = isset($data['order']) ? $data['order'] : '0';
            $description = isset($data['description']) ? $data['description'] : '';

            $attr->name = $name;
            $attr->slug = $slug;
            $attr->order = $order;
            $attr->description = $description;
            $result = $attr->save();
            if($result){
                echo 1;
                die;
            }
        }
        echo 0;
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
}
