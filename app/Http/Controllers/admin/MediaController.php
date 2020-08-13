<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Http\Request;
use DB;

class MediaController extends Controller
{
    public $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::table('media')->update(['order' => '0']);

        $mediaList = Media::orderBy('order', 'DESC')->orderBy('updated_at', 'DESC')->skip(0)->take($this->perPage)->get();
       // $mediaList = Media::all();
       
        return view('admin.media.index')->with('mediaList', $mediaList);
    }

    public function loadMore(Request $request){
        $data = $request->all();

        $pageCurrent = $data['page'];
        $from = ($pageCurrent - 1) * $this->perPage;
        $mediaList = Media::orderBy('order', 'DESC')->orderBy('updated_at', 'DESC')->skip($from)->take($this->perPage)->get()->toArray();
        
        echo json_encode($mediaList);
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
       // $data = $request->all();
        $res = [
            'status' => 0
        ];

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
                    $fileNameDir = date('YmdHis') . '_' .  $fileName;
                    $linkDirFile =   $dirFile . $fileNameDir;
                    $isUpload = $mediaImg->move($directory, $fileNameDir);

                    if($isUpload){
                        $dataInsert['title'] = $fileName;
                        $dataInsert['caption'] = '';
                        $dataInsert['guid'] = $linkDirFile;
                        $dataInsert['order'] = Media::max('order') + 1;
                        $dataInsert['created_at'] = date("Y-m-d H:i:s");
                        $dataInsert['updated_at'] = date("Y-m-d H:i:s");
                        
                        $id = Media::insertGetId($dataInsert);
                        if($id){
                            $res['status'] = 1;
                            $res['id'] = $id;
                            $res['guid'] = asset($linkDirFile);
                        }
                    }
                }
            }
        }

        echo json_encode($res);
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
    public function update(Request $request)
    {

        $data = $request->all();

        $id = $data['id'];
        $idOldItem = $data['idOldItem'];
        $order = $data['order'];

        $oldItem = Media::find($idOldItem);

        $media = Media::find($id);
        $media->order = $order;
        $media->updated_at = date("Y-m-d H:i:s", strtotime($oldItem->updated_at) + 1);
        $result = $media->save();
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        if($id){
            $media = Media::find($id);

            if($media->guid != '' && file_exists($media->guid)){
                unlink($media->guid);
            }
            $result = Media::destroy($id);
            if($result){
                echo 1;
                die;
            }
        }

        echo 0;
    }
}
