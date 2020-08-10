<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests\CategoryValidate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all()->toArray();

        return view('admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValidate $request)
    {
        $data = $request->all();

        $name = isset($data['name']) ? $data['name'] : '';
        $description = isset($data['description']) ? $data['description'] : '';
        $status = isset($data['status']) ? $data['status'] : '0';
        
        $dataInsert = [
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'image' => '',
        ];

        $result = Category::insertGetId($dataInsert);
        if($result){
            
            $catID = $result;
            if($catID && $request->hasFile('image')){
                $dirFile = 'uploads/category/' . date('Y') . '/' . date('m') . '/';
                $directory = public_path($dirFile);
                if(!file_exists($directory)){
                    mkdir($directory, 0775, true);
                }
                $catImg = $request->file('image');
                if($catImg->isValid()){
                    $ext = $catImg->getClientOriginalExtension(); // đuôi file
                    if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                        $fileName = $catImg->getClientOriginalName();
                        $fileName = $catID . '_' . $fileName;
                        $linkDirFile = $dirFile . $fileName;
                        $isUpload = $catImg->move($directory, $fileName);
                        if($isUpload){
                            $category = Category::find($catID);
                            $category->image = $linkDirFile;
                            $result = $category->save();

                            if($result){
                                return redirect(route('admin.category'))->with('success', 'Create new success');
                            }
                        }else{
                            return redirect()->back()->with('error', 'Error, Upload file failed, please try again');
                        }
                    }
                }
            }else if($result){
                return redirect(route('admin.category'))->with('success', 'Create new success');
            }
        }
        return redirect()->back()->with('error', 'An error occurred, please try again');
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
        $category = Category::find($id);

        return view('admin.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValidate $request, $id)
    {
        $category = Category::find($id);

        $data = $request->all();
        
        $category->name = isset($data['name']) ? $data['name'] : '';
        $category->description = isset($data['description']) ? $data['description'] : '';
        $category->status = isset($data['status']) ? $data['status'] : '0';

        if($request->hasFile('image')){
            $dirFile = 'uploads/category/' . date('Y') . '/' . date('m') . '/';
            $directory = public_path($dirFile);
            if(!file_exists($directory)){
                mkdir($directory, 0775, true);
            }
            $catImg = $request->file('image');
            if($catImg->isValid()){
                $ext = $catImg->getClientOriginalExtension(); // đuôi file
                if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                    $fileName = $catImg->getClientOriginalName();
                    $fileName = $category->id . '_' . $fileName;
                    $linkDirFile = $dirFile . $fileName;
                    $isUpload = $catImg->move($directory, $fileName);
                    if($isUpload){
                        $category->image = $linkDirFile;
                    }else{
                        return redirect()->back()->with('error', 'Error, Upload file failed, please try again');
                    }
                }
            }
        }
           
        $result = $category->save();

        if($result){
            return redirect(route('admin.category'))->with('success', 'Create new success');
        }

        return redirect()->back()->with('error', 'An error occurred, please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->image != '' && file_exists($category->image)){
            unlink($category->image);
        }

        Category::destroy($id);

        return redirect(route('admin.category'))->with('success', 'Delete success');
    }
}
