@extends('admin.layout')

@section('main')
<div class="content-wrapper">
  <form method="post" action="{{ route('admin.product.create.post') }}" enctype="multipart/form-data">
    @csrf()
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Product tags</h1>
          </div>
          <div class="col-sm-4">
          	<div class="input-group input-group-sm">
              <input type="text" class="form-control">
              <span class="input-group-append">
                <button type="button" class="btn btn-info btn-flat">Search</button>
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
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="button" class="btn btn-primary">Add new tag</button>
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
		                    <select class="custom-select">
			                    <option>Bulk Actions</option>
			                    <option>Delete</option>
			                  </select>
		                  </div>
               			</div>
               			<div class="col-md-6">
               				<button type="button" class="btn btn-secondary">Apply</button>
               			</div>
               		</div>
		              

										<table class="table table-striped">
										  <thead>
										    <tr>
										      <th scope="col">
										      	<div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" type="checkbox" id="customCheckbox2">
		                          <label for="customCheckbox2" class="custom-control-label"></label>
		                        </div>
										      </th>
										      <th scope="col">Name</th>
										      <th scope="col">Description</th>
										      <th scope="col">Slug</th>
										      <th scope="col">Count</th>
										    </tr>
										  </thead>
										  <tbody>
										    <tr>
										      <th>
										      	<div class="custom-control custom-checkbox">
		                          <input class="custom-control-input" type="checkbox" id="customCheckbox2">
		                          <label for="customCheckbox2" class="custom-control-label"></label>
		                        </div>
										      </th>
										      <td>Mark</td>
										      <td>Otto</td>
										      <td>mdo</td>
										      <td>1</td>
										    </tr>
										    
										  </tbody>
										</table>

									</div>
							</div>
            </div>
          </div>
        </div>
    </section>
  </form>
</div>

@endsection