@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  <form method="post" action="{{ route('admin.product.create.post') }}" enctype="multipart/form-data">
    @csrf()

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new product</h1>
          </div>
          
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Product name">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea class="textarea" name="description" value="{{ old('description') }}" placeholder="Place some text here"
                            style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Slug</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Regular price</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', '0') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Sale price</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" value="{{ old('price_sale', '0') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Product Short Description</label>
                    <textarea class="textarea" name="short_description" value="{{ old('short_description') }}" placeholder="Place some text here"
                            style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>

                  
                </div>
              </div>

            </div>

          	<div class="col-md-4">
              
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Public</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                  <div class="card-body">
                    
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label">Link out site</label>
                      <div class="col-sm-7">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="checkbox" name="is_out_site" value="1">
                            </span>
                          </div>
                          <input type="text" class="form-control" name="link_out_site" value="{{ old('link_out_site') }}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label">Product Code</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" value="{{ old('product_code') }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="status" value="1" name="status" checked>
                        <label for="status" class="custom-control-label">Display products</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="is_popular" value="1" name="is_popular" >
                        <label for="is_popular" class="custom-control-label">Popular</label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label">Published on</label>
                        <div class="col-sm-7 input-group date" id="published" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#published" name="published">
                            <div class="input-group-append" data-target="#published" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <button type="submit" class="btn btn-primary">Public</button>
                    </div>
                  </div>
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Product Categories</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                  <div class="card-body">
                    <!-- <select class="form-control" name="category">
                        <option value="0">-- Select --</option> -->
                        <?php
                          function showCategoriesOption($categories, $parent_id = 0, $char = ''){
                              foreach ($categories as $key => $item){
                                  if ($item['parent_id'] == $parent_id){
                                    ?>
                                    <!-- <option value="{{$item['id']}}">{{$char.$item['name']}}</option> -->
                                    <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        {!!$char!!}<input type="checkbox" checked="" id="{{$item['name']}}-{{$item['id']}}">
                                        <label for="{{$item['name']}}-{{$item['id']}}">{{$item['name']}}
                                        </label>
                                      </div>
                                    </div>
                                    <?php
                                      unset($categories[$key]);
                                      showCategoriesOption($categories, $item['id'], $char.'&emsp;');
                                  }
                              }
                          }
                          showCategoriesOption($categories);
                        ?>
                      <!-- </select> -->
                  </div>
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Product Tags</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <select class="product-tag" name="tags[]" multiple="multiple">
                          @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Product Image</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                  <div class="card-body">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary btn-media btn-image-large" data-toggle="modal" data-target=".modal-media">Set product image</button>
                    </div>

                    <div class="row product-large">
                      
                    </div>
                    <input type="hidden" name="product_large" value="">

                  </div>
              </div>

              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Product Gallery</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                  <div class="card-body">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary btn-media btn-image-gallery" data-toggle="modal" data-target=".modal-media">Add product gallery images</button>
                    </div>
                    <div class="row product-gallery">
                      <!-- <div class="col-md-4 item-media">
                        <div class="preview">
                          <img src="https://hasinhayder.github.io/ImageCaptionHoverAnimation/img/everycowboy_dribbbleready_shot.jpg">
                        </div>
                        <i class="fas fa-times-circle"></i>
                      </div> -->
                      
                    </div>
                    <input type="hidden" name="product_gallery" value="">
                  </div>
              </div>

            </div>

            
            
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </form>
</div>

@include('admin.modal.media', ['mediaList' => $mediaList])

@endsection


@section('scriptLink')
<script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/pages/product.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/pages/media-popup.js') }}"></script>

@endsection

@section('script')
  @if($errors->any() || \Session::has('error'))
    <?php
      $errorNotify = 'Please check the data';
      if(\Session::has('error')){
        $errorNotify = \Session::get('error');
      }
    ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $.notify("{{ $errorNotify }}", "error");
      });
    </script>
  @endif
  
@endsection