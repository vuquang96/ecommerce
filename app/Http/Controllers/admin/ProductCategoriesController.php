<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductCategories;
use App\Media;
use DB;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $catProduct = ProductCategories::all()->toArray();

        /*$catProduct = DB::table('product_categories')
                                ->join('media', 'product_categories.thumbnail', 'media.id')
                                ->select('product_categories.*', 'media.*')
                                ->get()->toArray();
                                        echo "<pre>";
                                        print_r($catProduct);
                                        echo "</pre>";die;*/
        $data = [
            'catProduct' => $catProduct,
        ];
        return view('admin.product_categories.index')->with($data);
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
         
          
            
        $name = $data['name'];
        $description = isset($data['description']) ? $data['description'] : '';
        $parentID = isset($data['parent_id']) ? $data['parent_id'] : null;
        $slug = $data['slug'];
        $thumbnail = isset($data['thumbnail']) ? $data['thumbnail'] : '';
        if(trim($slug) == ''){
            $slug = slugify($name);
        }else{
            $slug = slugify($slug);
        }
    
        $dataInsert = [
            'name' => $name,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'parent_id' => $parentID,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $id = ProductCategories::insertGetId($dataInsert);
       
        if($id){
            $cat = ProductCategories::find($id)->toArray();
            echo json_encode($cat);
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
    public function destroy(Request $request)
    {
        $data = $request->all();
        
        $ids = $data['ids'];
        if(is_array(($ids))){
                  
            DB::table('product_categories')->whereIn('parent_id',$ids)->update(['parent_id'=>null]);
           // ProductCategories::whereIn('parent_id',$ids)->update('parent_id', 'null');
            $result = ProductCategories::destroy($ids);
            if($result){
                echo 1;
                die;
            }
        }
        echo 0;
    }
}
