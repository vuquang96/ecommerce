@extends('admin.layout')


@section('main')
  <link rel="stylesheet"  href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Media</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <button type="button" class="btn btn-info btn-new">New</button>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="media_post" value="{{ route('admin.media.create.post') }}">
          <input type="hidden" name="media_update" value="{{ route('admin.media.update') }}">
          <input type="hidden" name="media_destroy" value="{{ route('admin.media.destroy') }}">
          <input type="hidden" name="media_loadmore" value="{{ route('admin.media.loadmore') }}">
          <input type="hidden" name="page" value="1">
          <input type="hidden" name="asset_link" value="{{asset('')}}">

          <div class="file-upload hide">
            <button class="file-upload-btn" type="button">Add Image</button>

            <div class="image-upload-wrap">
              <input class="file-upload-input" type='file' />
              <div class="drag-text">
                <h3>Drag and drop a file or select add Image</h3>
              </div>
            </div>
            <!-- <div class="file-upload-content">
              <img class="file-upload-image" src="#" alt="your image" />
              <div class="image-title-wrap">
                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
              </div>
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
						<ul id="media-img">
              @foreach($mediaList as $key => $item)
                <li class="item item-{{ $item->id }}" data-order="{{ $item->order }}" data-id="{{ $item->id }}">
                  <div class="preview">
                    <img src="{{ asset($item->guid ) }}">
                  </div>
                  <i class="fas fa-times-circle"></i>
                </li>
              @endforeach
						  
						</ul>
        	</div>
        </div>
      </div>
    </section>

  </div>


  
@endsection

@section('scriptLink')
  <script src="{{ asset('assets/admin/dist/js/pages/media.js') }}"></script>
@endsection