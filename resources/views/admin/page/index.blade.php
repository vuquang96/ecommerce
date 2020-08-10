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
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <div class=" float-sm-right">
              <a href="{{ route('admin.page.create') }}"  class="btn btn-success">
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th width="5%"></th>
                    <th width="5%"></th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($pages as $key => $item)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.page.edit', $item['id']) }}">{{ $item['name'] }}</a></td>
                        <td style="text-align: center;">
                          @if($item['status'])
                            <i class="fa fa-check" aria-hidden="true" style="color: #155724;"></i>
                          @else
                            <i class="fa fa-times" aria-hidden="true" style="color: #721c24;"></i>
                          @endif
                        </td>
                        <td style="text-align: center;">
                          <a href="{{ route('admin.page.destroy', $item['id']) }}">
                            <i class="fa fa-trash" aria-hidden="true" style="color: #721c24;"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th width="5%"></th>
                    <th width="5%"></th>
                  </tr>
                  </tfoot>
                </table>
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

@section('scriptLink')

<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

@endsection

@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@if(\Session::has('success'))
    <script type="text/javascript">
      $(document).ready(function(){
        $.notify("{{ \Session::get('success') }}", "success");
      });
    </script>
  @endif
@endsection