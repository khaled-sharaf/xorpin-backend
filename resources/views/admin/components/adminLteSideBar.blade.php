<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CP - {{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          {{-- <li class="nav-item has-treeview menu-open"> --}}

          <li class="nav-item">
            <a href="{{ aurl('/') }}" class="nav-link {{ active_link_cp('dashboard') . active_link_cp('', false) }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ active_link_cp('users') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">130</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('test') }}" class="nav-link {{ active_link_url(route('test')) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View all users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add user</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Statistics</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
