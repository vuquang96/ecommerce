@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  <form method="post" action="{{ route('admin.product.update', $product['id']) }}"  enctype="multipart/form-data">
    @csrf()
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $product['name'] }}</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <button type="reset" class="btn btn-warning">Reset</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Image</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="image">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    
                    @if($product['image'] != '')
                      <img src="{{ asset($product['image']) }}" style="width:100%;
" />
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- left column -->
            <div class="col-md-6">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Link out site</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <input type="checkbox" name="is_out_site" value="1">
                          </span>
                        </div>
                        <input type="text" class="form-control" name="link_out_site" value="{{ old('link_out_site', $product['link_out_site']) }}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Product Code</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" value="{{ old('product_code', $product['product_code']) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product['name']) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product['price']) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Price Sale</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" value="{{ old('price_sale', $product['price_sale']) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Slug</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="slug" value="{{ old('slug', $product['slug']) }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="category">
                        <option value="0">-- Select --</option>
                        @foreach($categories as $key => $category)
                          <option value="{{ $category['id'] }}" <?php echo ($product['category'] == $category['id'] ) ? 'selected' : ''; ?>>{{ $category['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="status" value="1" name="status" <?php echo ($product['status'] == 1) ? 'checked' : '' ?> >
                      <label for="status" class="custom-control-label">Display products</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product description</label>
                    <textarea class="textarea" name="description"  placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description', $product['description']) }}</textarea>
                  </div>
                  
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

@endsection


@section('scriptLink')
<script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

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
  @elseif(\Session::has('success'))
    <script type="text/javascript">
      $(document).ready(function(){
        $.notify("Update success", "success");
      });
    </script>
  @endif
@endsection