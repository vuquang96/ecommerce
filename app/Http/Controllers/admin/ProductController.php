<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Products;
use App\ProductCategories;
use App\Media;
use App\ProductTags;

use App\Http\Requests\ProductValidate;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all()->toArray();
           
        return view('admin.product.index', ['products' => $products]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategories::all()->toArray();
        $tags = ProductTags::all();
        
               
        $data = [
            'categories'    => $categories,
            'tags'          => $tags,
        ];
        return view('admin.product.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidate $request)
    {
        $data = $request->all();
         
        $is_out_site =  isset($data['is_out_site']) ? $data['is_out_site'] : '0';
        $link_out_site =  isset($data['link_out_site']) ? $data['link_out_site'] : '';
        $name =  isset($data['name']) ? $data['name'] : '';
        $price =  isset($data['price']) ? $data['price'] : '0';
        $priceSale =  isset($data['price_sale']) ? $data['price_sale'] : '0';
        $product_code =  isset($data['product_code']) ? $data['product_code'] : '';
        $slug =  isset($data['slug']) ? $data['slug'] : '';
        $description =  isset($data['description']) ? $data['description'] : '';
        $status =  isset($data['status']) ? $data['status'] : '1';
        $categories =  isset($data['categories']) ? $data['categories'] : [];
        $is_popular =  isset($data['is_popular']) ? $data['is_popular'] : '0';
        $short_description =  isset($data['short_description']) ? $data['short_description'] : '';
        $product_large =  isset($data['product_large']) ? $data['product_large'] : '';
        $product_gallery =  isset($data['product_gallery']) ? $data['product_gallery'] : '';
        $published =  isset($data['published']) ? date('Y-m-d H:i:s', strtotime($data['published'])) : date('Y-m-d H:i:s');
        $tags =  isset($data['tags']) ? $data['tags'] : [];

        $categories = implode(',', $categories);
        $tags =  implode(',', $tags) ;


        $dataInsert = [
            'link_out_site' => $link_out_site,
            'name' => $name,
            'price' => $price,
            'price_sale' => $priceSale,
            'product_code' => $product_code,
            'slug' => $slug,
            'description' => $description,
            'image' => $product_large,
            'image_gallery' => $product_gallery,
            'tags' => $tags,
            'short_description' => $short_description,
            'categories' => $categories,
        ];

        foreach ($dataInsert as $key => $value) {
            $dataInsert[$key] = "'" . $value . "'";
        }

      

        $dataInsert['is_out_site'] = $is_out_site;
        $dataInsert['is_popular'] = $is_popular;
        $dataInsert['status'] = $status;
        $dataInsert['published'] = $published;
 
  
       // $result = $product->save();
        $result = Products::insertGetId($dataInsert);
       

        
        if($result){
            return redirect(route('admin.product'))->with('success', 'Create product success');
        }
        return redirect()->back()->with('error', 'Error, please try again');
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
    public function edit($id){
        $categories = Category::where('status', '1')->get()->toArray();
        $product = Products::find($id)->toArray();
        
        return view('admin.product.edit')->with(['product' => $product, 'categories' => $categories]);
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
        $product = Products::find($id);
        

        $validateData = $request->validate([
            'name' => 'required',
            'product_code' => 'required|max:50',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);


        $data           = $request->all();
            
        $product->is_out_site    =  isset($data['is_out_site']) ? $data['is_out_site'] : '0';
        $product->link_out_site  =  isset($data['link_out_site']) ? $data['link_out_site'] : '';
        $product->name           =  isset($data['name']) ? $data['name'] : '';
        $product->price =  isset($data['price']) ? $data['price'] : '0';
        $product->price_sale =  isset($data['price_sale']) ? $data['price_sale'] : '0';
        $product->product_code   =  isset($data['product_code']) ? $data['product_code'] : '';
        $product->slug           =  isset($data['slug']) ? $data['slug'] : '';
        $product->description    =  isset($data['description']) ? $data['description'] : '';
        $product->status         =  isset($data['status']) ? $data['status'] : '0';
        $product->category         =  isset($data['category']) ? $data['category'] : '0';
        $product->is_popular         =  isset($data['is_popular']) ? $data['is_popular'] : '0';
        
            
        if($request->hasFile('image')){
            $dirFile = 'uploads/product/' . date('Y') . '/' . date('m') . '/';
            $directory = public_path($dirFile);
            if(!file_exists($directory)){
                mkdir($directory, 0775, true);
            }
            if($product->image != '' && file_exists($product->image)){
                unlink($product->image);
            }

            $productImg = $request->file('image');
            if($productImg->isValid()){
                $ext = $productImg->getClientOriginalExtension(); // lấy đuôi file
                if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                    $fileName = $productImg->getClientOriginalName();
                    $fileName = $product->id . '_' . $fileName;
                    $LinkDirFile = $dirFile . $fileName;
                    $isUpload = $productImg->move($directory, $fileName);

                    if($isUpload){
                        $product->image = $LinkDirFile;
                    }else{
                        return redirect()->back()->with('error', 'Error, Upload file failed, please try again');
                    }
                }else{
                    return redirect()->back()->with('error', 'Unsupported file format');
                }
            }
        }

        $update = $product->save();
        if($update){
            return redirect()->back()->with('success', 'Update product success');
        }
        return redirect()->back()->with('error', 'Error, please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        if($product->image != '' && file_exists($product->image)){
            unlink($product->image);
        }
        Products::destroy($id);
        return redirect(route('admin.product'))->with('success', 'Delete successful
');
    }
}
