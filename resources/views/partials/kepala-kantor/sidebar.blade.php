        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column">
                <div class="image w-100 p-0">
                    <img src="{{ asset('storage/images/user/' . auth()->user()->image) }}" class="w-100 rounded"
                        alt="User Image" />
                </div>
                <div class="mx-2 my-2">
                    <a href="#" class="d-block text-center">
                        <h5 class="m-0">{{ auth()->user()->name }}</h5>
                    </a>
                    <p class="mb-1 text-center" style="color: #c2c7d0">
                        {{ auth()->user()->role->role }}
                    </p>
                    <a href="{{ route('userKepalaKantor.profile') }}">
                        <button class="btn btn-primary btn-md w-100">
                            <b>Profile</b>
                        </button>
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search" />
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-header">
                        <h5 class="m-0">Menu</h5>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lckhKepalaKantor.index') }}"
                            class="nav-link {{ Request::is('kepala-kantor/lckh*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>Upload LCKH</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listLCKHKepalaKantor.index') }}"
                            class="nav-link {{ Request::is('kepala-kantor/list-upload-lckh*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>List Upload LCKH</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('recapDataKepalaKantor.index') }}"
                            class="nav-link {{ Request::is('kepala-kantor/rekap-data*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>Rekap Data</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
