<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mediaList = Media::all();
           
        return view('admin.media.index')->with('mediaList', $mediaList);
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
       /* $data = $request->all();
            echo "<pre>";
            print_r($data);
            echo "<pre>";die;*/

        if($request->hasFile('file')){
            $dirFile = 'uploads/media/'. date('Y') . '/' . date('m') . '/';

            $directory = public_path($dirFile);
            if(!file_exists($directory)){
                mkdir($directory, 0775, true);
            }

            $mediaImg = $request->file('file');
            if($mediaImg->isValid()){
                $ext = $mediaImg->getClientOriginalExtension();// lấy đuôi file
                if(in_array($ext, ['png', 'jpg', 'jpeg'])){
                    $fileName = $mediaImg->getClientOriginalName();
                    $linkDirFile = $dirFile . $fileName;
                    $isUpload = $mediaImg->move($directory, $fileName);

                    if($isUpload){
                        $dataInsert['title'] = $fileName;
                        $dataInsert['caption'] = '';
                        $dataInsert['guid'] = $linkDirFile;
                        $dataInsert['order'] = 0;
                        $result = Media::insert($dataInsert);
                        if($result){
                            echo 1;die;
                        }
                    }
                }
            }
        }

        echo '0';die;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
