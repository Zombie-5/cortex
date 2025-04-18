 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Cortex</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index')}}">
            <i class="fas fa-user"></i>
            <span>Usúarios</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.index')}}">
            <i class="fas fa-box"></i>
            <span>Produtos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.bank.index')}}">
            <i class="fas fa-bank"></i>
            <span>Bancos</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.transaction.index') }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Transações</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.gift.index') }}">
            <i class="fas fa-gift"></i>
            <span>Presentes</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.link.index') }}">
            <i class="fas fa-link"></i>
            <span>Links</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notices.index') }}">
            <i class="fa fa-newspaper"></i>
            <span>Noticias</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.link.index') }}">
            <i class="fas fa-images"></i>
            <span>Carrossel</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-file-alt"></i>
            <span>Relatórios</span>
        </a>
    </li> --}}

   {{--  <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}
</ul>
<!-- End of Sidebar -->