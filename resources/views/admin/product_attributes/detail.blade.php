@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  
    @csrf()
    <input type="hidden" name="attr_post" value="{{ route('admin.product.attr.post') }}">
    <input type="hidden" name="tag_destroy" value="{{ route('admin.product.tag.destroy') }}">
    <input type="hidden" name="term_update" value="{{ route('admin.product.attr.update') }}">
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    <input type="hidden" name="type" value="1">
    <input type="hidden" name="id" id="id_term" value="">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Terms</h1>
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
                  <div class="form-group">
                    <label>Order</label>
                    <input type="text" class="form-control" id="order">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-new-term">Add new term</button>
                  <button type="button" class="btn btn-info btn-edit-term hide">Edit term</button>
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
										      <th scope="col">Description</th>
										      <th scope="col">Slug</th>
                          <th scope="col">Order</th>
										      <th scope="col">Count</th>
										    </tr>
										  </thead>
										  <tbody id="term-list">
                        @foreach($terms as $term)
  										    <tr class="term-item term-{{$term->id}}">
  										      <td class="term-name" data-id="{{$term->id}}">{{ $term->name }}</td>
                            <td class="term-des">{{ $term->description }}</td>
  										      <td class="term-slug">{{ $term->slug }}</td>
                            <td class="term-order">{{ $term->order }}</td>
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
  <script src="{{ asset('assets/admin/dist/js/pages/product-attr-detail.js') }}"></script>
@endsection