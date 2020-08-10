@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  <form method="post" action="{{ route('admin.page.create.post') }}" enctype="multipart/form-data">
    @csrf()
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Page</h1>
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
                  <h3 class="card-title">Content</h3>
                </div>
                  <div class="card-body">
                    <div class="form-group">
                      <textarea class="textarea @error('content') is-invalid @enderror" name="content"   value="{{ old('content') }}" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                    <label class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Slug</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="status" value="1" name="status" checked>
                      <label for="status" class="custom-control-label">Display</label>
                    </div>
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
  @endif
@endsection