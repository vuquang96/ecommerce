@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  
    @csrf()
    <input type="hidden" name="tag_post" value="{{ route('admin.product.tag.post') }}">
    <input type="hidden" name="tag_destroy" value="{{ route('admin.product.tag.destroy') }}">
    <input type="hidden" name="tag_update" value="{{ route('admin.product.tag.update') }}">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Attributes</h1>
          </div>
          <div class="col-sm-4">
          	
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
						<div class="col-md-4">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="name">Slug</label>
                    <input type="text" class="form-control" id="slug">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."></textarea>
                  </div>
                  <input type="hidden" name="id" id="id_tag" value="">
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-new-tag">Add new tag</button>
                  <button type="button" class="btn btn-info btn-edit-tag hide">Edit tag</button>
                </div>
              </div>
            </div>
            <div class="col-md-8">
            	<div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
               	<div class="card-body">
              
		              

										<table class="table table-striped">
										  <thead>
										    <tr>
										      <th scope="col">Name</th>
										      <th scope="col">Slug</th>
										      <th scope="col">Order By</th>
										      <th scope="col">Terms</th>
										    </tr>
										  </thead>
										  <tbody id="attr-list">
                        @foreach($attributes as $attr)
  										    <tr class="attr-item attr-{{$attr->id}}">
  										      <td class="attr-name" data-id="{{$attr->id}}">{{ $attr->name }}</td>
                            <td class="attr-des">{{ $attr->slug }}</td>
  										      <td class="attr-slug">{{ $attr->order }}</td>
  										      <td>1</td>
  										    </tr>
										    @endforeach
										  </tbody>
										</table>

									</div>
							</div>
            </div>
          </div>
        </div>
    </section>
</div>

@endsection

@section('scriptLink')
  <script src="{{ asset('assets/admin/dist/js/pages/product-tag.js') }}"></script>
@endsection