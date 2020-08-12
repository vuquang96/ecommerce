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
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="file-upload">
            <button class="file-upload-btn" type="button">Add Image</button>

            <div class="image-upload-wrap">
              <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
              <!-- <div class="drag-text">
                <h3>Drag and drop a file or select add Image</h3>
              </div> -->
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
                <li class="item">
                  <div class="preview">
                    <img src="{{ asset($item->guid ) }}">
                  </div>
                </li>
              @endforeach
						  
              
						</ul>
        	</div>
        </div>
      </div>
    </section>

  </div>

 <style>
  ul#media-img{
    display: inline-block;
  }
 	ul#media-img li {
 		width: 20%;
 		padding: 10px;
 		height: 200px;
 		display: inline-block;
 		float: left;
    cursor: all-scroll;
    position: relative;
      overflow: hidden;
    
    padding: 10px;
 	}
  ul#media-img li:before {
    font-family: "Font Awesome 5 Free";
    content: "\f057";
    display: inline-block;
    vertical-align: middle;
    position: absolute;
    right: 0;
    top: 0;
    font-size: 20px;
    cursor: pointer;
  }
  ul#media-img li img{
    width: 100%;
  }
  ul#media-img .preview{
    overflow: hidden;
    max-height: 100%;
    border: 1px solid #999;
  }
  .file-upload {
    background-color: #ffffff;
    width: 600px;
    margin: 0 auto;
    padding: 20px;
  }

  .file-upload-btn {
    width: 100%;
    margin: 0;
    color: #fff;
    background: #1FB264;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #15824B;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .file-upload-btn:hover {
    background: #1AA059;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .file-upload-btn:active {
    border: 0;
    transition: all .2s ease;
  }

  .file-upload-content {
    display: none;
    text-align: center;
  }

  .file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
  }

  .image-upload-wrap {
    margin-top: 20px;
    border: 4px dashed #1FB264;
    position: relative;
  }

  .image-dropping,
  .image-upload-wrap:hover {
    background-color: #1FB264;
    border: 4px dashed #ffffff;
  }

  .image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
  }

  .drag-text {
    text-align: center;
  }

  .drag-text h3 {
    font-weight: 100;
    text-transform: uppercase;
    color: #15824B;
    padding: 60px 0;
  }

  .file-upload-image {
    max-height: 200px;
    max-width: 200px;
    margin: auto;
    padding: 20px;
  }

  .remove-image {
    width: 200px;
    margin: 0;
    color: #fff;
    background: #cd4535;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #b02818;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
  }

  .remove-image:hover {
    background: #c13b2a;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
  }

  .remove-image:active {
    border: 0;
    transition: all .2s ease;
  }
  
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#media-img" ).sortable();
    $( "#media-img" ).disableSelection();

    $(".file-upload-btn").click(function(){
      $('.file-upload-input').trigger('click');
    });
    $(document).on('change', '.file-upload-input', function(){
      var file_data = $('.file-upload-input').prop('files')[0];
      //lấy ra kiểu file
      var type = file_data.type;
      //Xét kiểu file được upload
      var match = ["image/gif", "image/png", "image/jpg"];
      if (type == match[0] || type == match[1] || type == match[2]) {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            var token = $('input[name="_token"]').val();
            form_data.append('_token', token);
            console.log(form_data);
            //sử dụng ajax post
            $.ajax({
                url: '<?php echo route('admin.media.create.post'); ?>', 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                  console.log(res);
                   /* $('.status').text(res);
                    $('#file').val('');*/
                }
            });
        } else {
            $('.status').text('Chỉ được upload file ảnh');
            $('#file').val('');
        }
    });
 


  } );
  function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
});
  </script>
@endsection