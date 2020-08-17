@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  
    @csrf()
    <input type="hidden" name="cat_post" value="{{ route('admin.product.cat.post') }}">
    <input type="hidden" name="cat_destroy" value="{{ route('admin.product.cat.destroy') }}">
    <input type="hidden" name="tag_update" value="{{ route('admin.product.tag.update') }}">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Product categories</h1>
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
              <div class="card card-info">
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
                    <label>Parent Category</label>
                    <select class="form-control" id="parent_id">
                      <option value="">None</option>
                        <?php
                            function showCategoriesOption($categories, $parent_id = 0, $char = ''){
                                foreach ($categories as $key => $item){
                                    if ($item['parent_id'] == $parent_id){
                                      ?>
                                      <option value="{{$item['id']}}">{{$char.$item['name']}}</option>
                                      <?php
                                        unset($categories[$key]);
                                        showCategoriesOption($categories, $item['id'], $char.'—');
                                    }
                                }
                            }
                            showCategoriesOption($catProduct);
                          ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" id="description" placeholder="Enter ..."></textarea>
                  </div>
                  <div class="form-group">
                    <label>Thumbnail</label>
                    <div>
                      <div id="product_cat_thumbnail">
                        <img src="{{asset('assets/admin/dist/img/placeholder.png')}}"></div>
                      <button type="button" class="btn btn-success btn-thumnail">Upload/Add image</button>
                    </div>
                    
                  </div>
                  <input type="hidden" name="id" id="id_cat" value="">
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary btn-new-cat">Add new category</button>
                  <button type="button" class="btn btn-info btn-edit-cat hide">Edit category</button>
                </div>
              </div>
            </div>
            <div class="col-md-8">
            	<div class="card card-info">
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
		                          <input class="custom-control-input" value="all" type="checkbox" id="all-cat">
		                          <label for="all-cat" class="custom-control-label"></label>
		                        </div>
										      </th>
										      <th scope="col">Image</th>
                          <th scope="col">Name</th>
										      <th scope="col">Description</th>
										      <th scope="col">Slug</th>
										      <th scope="col">Count</th>
										    </tr>
										  </thead>
										  <tbody id="cat-list">

                        <?php
                          function showCategories($categories, $parent_id = 0, $char = ''){
                              foreach ($categories as $key => $item){
                                  if ($item['parent_id'] == $parent_id){
                                    ?>
                                    <tr class="cat-item cat-{{$item['id']}}">
                                      <th>
                                        <div class="custom-control custom-checkbox">
                                          <input class="custom-control-input" type="checkbox" id="cat-{{$item['id']}}" value="{{$item['id']}}">
                                          <label for="cat-{{$item['id']}}" class="custom-control-label"></label>
                                        </div>
                                      </th>
                                      <td class="cat-thumbnail">img</td>
                                      <td class="cat-name" data-id="{{$item['id']}}">{{$char}}{{$item['name']}}</td>
                                      <td class="cat-des">{{$item['description']}}</td>
                                      <td class="cat-slug">{{$item['slug']}}</td>
                                      <td>1</td>
                                    </tr>
                                    <?php
                                      unset($categories[$key]);
                                      showCategories($categories, $item['id'], $char.'—');
                                  }
                              }
                          }
                          showCategories($catProduct);
                        ?>

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
  <script src="{{ asset('assets/admin/dist/js/pages/product-cat.js') }}"></script>
@endsection