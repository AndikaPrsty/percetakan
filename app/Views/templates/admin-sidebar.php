<!-- Main Sidebar Container -->
<aside class="main-sidebar text-sm sidebar-light-pink elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link navbar-pink">
        <img src="/image/logo/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bold text-white">Bita Merchandise</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/image/logo/users-cog-solid.svg" style="color: white;" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview" id="">
                    <a href="#" class="nav-link" id="nav-link-dashboard">
                        <i class="nav-icon fas fa-tachometer-alt "></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fas fa-inbox nav-icon"></i>
                                <p>Pesanan Masuk</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <hr class="bg-secondary hr">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" id="nav-link-masterdata">
                        <i class="nav-icon far fa-folder-open"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/produk" class="nav-link" id="produk-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kategori" class="nav-link" id="kategori-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
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