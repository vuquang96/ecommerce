@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  
    @csrf()
    <input type="hidden" name="attr_post" value="{{ route('admin.product.attr.post') }}">
    <input type="hidden" name="attr_update" value="{{ route('admin.product.attr.update') }}">
    <input type="hidden" name="router_detail" value="{{route('admin.product.attr.detail', '9999')}}">
    <input type="hidden" name="id" id="id_attr" value="">

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
                    <label>Order</label>
                    <input type="text" class="form-control" id="order">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-new-attr">Add new Attribute</button>
                  <button type="button" class="btn btn-info btn-edit-attr hide">Edit Attribute</button>
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
										      <th scope="col">Order</th>
										      <th scope="col">Terms</th>
										    </tr>
										  </thead>
										  <tbody id="attr-list">
                        @foreach($attributes as $attr)
  										    <tr class="attr-item attr-{{$attr->id}}">
  										      <td class="attr-name" data-id="{{$attr->id}}">
                              <a href="{{route('admin.product.attr.detail', $attr->id)}}">{{ $attr->name }}</a>
                              <div class="row-actions">
                                  <span class="edit" data-id="{{$attr->id}}">Edit</span>
                              </div>
                            </td>
                            <td class="attr-slug">{{ $attr->slug }}</td>
  										      <td class="attr-order">{{ $attr->order }}</td>
  										      <td class="attr-term">1</td>
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
  <script src="{{ asset('assets/admin/dist/js/pages/product-attr.js') }}"></script>
@endsection