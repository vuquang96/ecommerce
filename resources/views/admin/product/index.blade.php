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
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <div class=" float-sm-right">
              <a href="{{ route('admin.product.create') }}"  class="btn btn-success">
                Create
              </a>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
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
                      <th scope="col">SKU</th>
                      <th scope="col">Stock</th>
                      <th scope="col">Price</th>
                      <th scope="col">Categories</th>
                      <th scope="col">Tags</th>
                      <th scope="col"><i class="fas fa-star"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                          <label for="customCheckbox2" class="custom-control-label"></label>
                        </div>
                      </th>
                      <td>
                        WordPress Pennant
                        <div class="row-actions">
                          <span class="id">ID: 40 | </span>
                          <span class="edit"><a href="#" aria-label="Edit">Edit</a> | </span>
                          <span class="trash"><a href="#" class="submitdelete" aria-label="Move">Trash</a> | </span>
                          <span class="view"><a href="#">View</a> | </span>
                          <span class="duplicate"><a href="#" aria-label="" rel="permalink">Duplicate</a></span>
                        </div>
                      </td>
                      <td>wp-pennant</td>
                      <td>In stock</td>
                      <td>$11.05</td>
                      <td>Decor</td>
                      <td></td>
                      <td><i class="fas fa-star"></i></td>
                    </tr>
                    
                  </tbody>
                </table>
                <ul class="pagination" style="float: right;">
                  <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                  </li>
                  <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                  </li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                  </li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                  </li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                  </li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                  </li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                  </li>
                  <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                  </li>
              </ul>
              </div>
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection



@section('script')


@if(\Session::has('success'))
    <script type="text/javascript">
      $(document).ready(function(){
        $.notify("{{ \Session::get('success') }}", "success");
      });
    </script>
  @endif
@endsection