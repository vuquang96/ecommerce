<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideList = Slide::all()->toArray();
                
        return view('admin.slide.index', ['slideList' => $slideList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required'
        ]);

        $data = $request->all();

        $name = isset($data['name']) ? $data['name'] : '';
        $is_out_site = isset($data['is_out_site']) ? $data['is_out_site'] : '0';
        $link_out_site = isset($data['link_out_site']) ? $data['link_out_site'] : '';
        $status = isset($data['status']) ? $data['status'] : '0';

        $dataInsert = [];
        $dataInsert['name'] = $name;
        $dataInsert['is_out_site'] = $is_out_site;
        $dataInsert['link_out_site'] = $link_out_site;
        $dataInsert['status'] = $status;
        $dataInsert['image'] = '';

        if($request->hasFile('image')){
            $dirFile = 'uploads/slide/'. date('Y') . '/' . date('m') . '/';

            $directory = public_path($dirFile);
            if(!file_exists($directory)){
                mkdir($directory, 0775, true);
            }

            $slideImg = $request->file('image');
            if($slideImg->isValid()){
                $ext = $slideImg->getClientOriginalExtension();// lấy đuôi file
                if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                    $fileName = $slideImg->getClientOriginalName();
                    $linkDirFile = $dirFile . $fileName;
                    $isUpload = $slideImg->move($directory, $fileName);

                    if($isUpload){
                        $dataInsert['image'] = $linkDirFile;
                    }else{
                        return redirect()->back()->with('error', 'Error, Upload file failed, please try again');
                    }
                }else{
                    return redirect()->back()->with('error', 'Unsupported file format');
                }
            }
        }

        $insert = Slide::insert($dataInsert);

        if($insert){
            return redirect(route('admin.slide'))->with('success', 'Insert Success');
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
        $slide = Slide::find($id)->toArray();
           
        return view('admin.slide.edit', ['slide' => $slide]);
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
        $slide = Slide::find($id);

       

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required'
        ]);
        $data = $request->all();

        $slide->name = isset($data['name']) ? $data['name'] : '';
        $slide->is_out_site = isset($data['is_out_site']) ? $data['is_out_site'] : '0';
        $slide->link_out_site = isset($data['link_out_site']) ? $data['link_out_site'] : '';
        $slide->status = isset($data['status']) ? $data['status'] : '0';


        if($request->hasFile('image')){

            $dirFile = 'uploads/slide/' . date('Y') . '/' . date('m') . '/';
            $directory = public_path($dirFile);
            if($slide->image != '' && file_exists($slide->image)){
                unlink($slide->image);
            }
            $slideImg = $request->file('image');
            if($slideImg->isValid()){
                $ext = $slideImg->getClientOriginalExtension();
                if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                    $fileName = $slideImg->getClientOriginalName();
                    $linkDirFile = $dirFile . $fileName;
                    $isUpload = $slideImg->move($directory, $fileName);
                    if($isUpload){
                        $slide->image = $linkDirFile;
                    }else{
                        return redirect()->back()->with('error', 'Error, Upload file failed, Please try again');
                    }
                }else{
                    return redirect()->back()->with('error', 'Unsupported file format');
                }
            }
        }

        $update = $slide->save();

        if($update){
            return redirect()->back()->with('success', 'Update success');
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
        $slide = Slide::find($id);

        if($slide->image != '' && file_exists($slide->image)){
            unlink($slide->image);
        }
        Slide::destroy($id);

        return redirect(route('admin.slide'))->with('success', 'Delete success');
    }
}
