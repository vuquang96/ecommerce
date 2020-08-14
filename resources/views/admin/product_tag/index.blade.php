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
            <h1>Product tags</h1>
          </div>
          <div class="col-sm-4">
          	<div class="input-group input-group-sm">
              <input type="text" class="form-control keyword">
              <span class="input-group-append">
                <button type="button" class="btn btn-info btn-flat btn-search">Search</button>
              </span>
            </div>
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
               		<div class="row">
               			<div class="col-md-6">
               				<div class="form-group">
		                    <select class="custom-select select-action">
			                    <option value="">Bulk Actions</option>
			                    <option value="delete">Delete</option>
			                  </select>
		                  </div>
               			</div>
               			<div class="col-md-6">
               				<button type="button" class="btn btn-secondary btn-apply">Apply</button>
               			</div>
               		</div>
		              

										<table class="table table-striped">
										  <thead>
										    <tr>
										      <th scope="col">
										      	<div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" value="all" type="checkbox" id="all-tag">
		                          <label for="all-tag" class="custom-control-label"></label>
		                        </div>
										      </th>
										      <th scope="col">Name</th>
										      <th scope="col">Description</th>
										      <th scope="col">Slug</th>
										      <th scope="col">Count</th>
										    </tr>
										  </thead>
										  <tbody id="tag-list">
                        @foreach($tags as $tag)
  										    <tr class="tag-item tag-{{$tag->id}}">
  										      <th>
  										      	<div class="custom-control custom-checkbox">
  		                          <input class="custom-control-input" type="checkbox" id="tag-{{$tag->id}}" value="{{$tag->id}}">
  		                          <label for="tag-{{$tag->id}}" class="custom-control-label"></label>
  		                        </div>
  										      </th>
  										      <td class="tag-name" data-id="{{$tag->id}}">{{ $tag->name }}</td>
                            <td class="tag-des">{{ $tag->description }}</td>
  										      <td class="tag-slug">{{ $tag->slug }}</td>
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