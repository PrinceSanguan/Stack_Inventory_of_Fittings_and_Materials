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

        <!-- Purchase Order -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.purchase') }}" class="nav-link {{ Route::is('admin.purchase') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
              Purchase Order
            </p>
          </a>
        </li>

        <!-- Item -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.category') }}" class="nav-link {{ Route::is('admin.category') ? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>
              Add Item
            </p>
          </a>
        </li>

        <!-- All Category -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              All Category
            </p>
          </a>
        </li>

        <li class="nav-header" style="font-size: 1.2em; color: yellow;">CATEGORY</li>

        <!-- Service Connection -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.connection') }}" class="nav-link {{ Route::is('admin.connection') ? 'active' : '' }}">
            <i class="nav-icon fas fa-plug"></i>
            <p>
              Service Connection
            </p>
          </a>
        </li>

        <!-- Repair and Maintenance -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.repair') }}" class="nav-link {{ Route::is('admin.repair') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              Repair and Maintenance
            </p>
          </a>
        </li>

        <!-- 30M NG Subsidy Project -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.subsidy') }}" class="nav-link {{ Route::is('admin.subsidy') ? 'active' : '' }}">
            <i class="nav-icon fas fa-project-diagram"></i>
            <p>
              30M NG Subsidy Project
            </p>
          </a>
        </li>

        <!-- Donation -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.donation') }}" class="nav-link {{ Route::is('admin.donation') ? 'active' : '' }}">
            <i class="nav-icon fas fa-hand-holding-usd"></i>
            <p>
              Donation
            </p>
          </a>
        </li>

        <!-- Maintenance (Gen.set) -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.maintenance') }}" class="nav-link {{ Route::is('admin.maintenance') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Maintenance (Gen.set)
            </p>
          </a>
        </li>

        <!-- MSWD Inventory -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.mswd') }}" class="nav-link {{ Route::is('admin.mswd') ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              MSWD Inventory
            </p>
          </a>
        </li>

        <!-- Accountable Forms -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.accountable') }}" class="nav-link {{ Route::is('admin.accountable') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
              Accountable Forms
            </p>
          </a>
        </li>
        
        <!-- Purchase History -->
        <li class="nav-item menu-open" style="margin-bottom: 10px;">
          <a href="{{ route('admin.purchase-history') }}" class="nav-link {{ Route::is('admin.purchase-history') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i> <!-- Changed icon -->
            <p>
              Purchase History
            </p>
          </a>
        </li>

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
