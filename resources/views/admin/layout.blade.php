<!DOCTYPE html>
<html lang="en">

@include('admin.layout.header')
@yield('styleLink')
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar') 

    @yield('main')
    
    
    @include('admin.layout.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

  @yield('scriptLink')
  @yield('script')
</body>

</html>
