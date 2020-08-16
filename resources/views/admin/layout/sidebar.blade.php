<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}"  class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

   
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.product') }}" class="{{ request()->is('admin/product*') ? 'active' : '' }} nav-link">
            <i class="fab fa-product-hunt"></i>
            <p>
              Products
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.product') }}" class="{{ request()->is('admin/product') ? 'active' : '' }} nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.product.create')}}" class="nav-link  {{request()->is('admin/product/create') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.product.cat')}}" class="nav-link {{ request()->is('admin/product-cat') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.product.tag') }}" class="{{ request()->is('admin/product-tag') }} nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tags</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Posts
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/examples/invoice.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Posts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/examples/invoice.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/examples/invoice.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/examples/invoice.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tags</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item ">
          <a href="{{ route('admin.product') }}" class="{{ request()->is('admin/product*') ? 'active' : '' }} nav-link ">
            <i class="fas fa-circle nav-icon"></i>
            <p>  Product  </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="{{ route('admin.slide') }}" class="{{ request()->is('admin/slide') ? 'active' : '' }} nav-link ">
            <i class="fas fa-circle nav-icon"></i>
            <p>  Slide  </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.page') }}" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>  Pages </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.category') }}" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>  Category </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>  News </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.media') }}" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>  Media </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>  Settings </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>