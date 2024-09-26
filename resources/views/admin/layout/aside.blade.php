    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
  
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">Administrator</a>
          </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item menu-open">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <!-- Categories -->
            <li class="nav-item">
              <a href="{{ route('admin.category') }}" class="nav-link {{ Route::is('admin.category') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                 Add Categories
                </p>
              </a>
            </li>
        
{{--             <!-- Item Records -->
            <li class="nav-item">
              <a href="{{ route('admin.record-day') }}" class="nav-link {{ Route::is('admin.record-day') ? 'active' : '' }}">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Record Table
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.record-day') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Day</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.record-week') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Week</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.record-month') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Month</p>
                  </a>
                </li>
              </ul>
            </li> --}}

            <!-- Logout Link -->
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

