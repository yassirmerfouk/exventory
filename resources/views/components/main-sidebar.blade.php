<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="{{ asset('img/temp_logo_white.png') }}" alt="Exventory Logo" class="mx-auto d-block"
            style="width: 200px">
        {{-- <span class="brand-text font-weight-light">Exventory</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->

        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="{{ __('search') }}"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @can('invoice_show')
                    <x-sidebar-elements.treeview fa-icon="fab fa-product-hunt" text="{{ __('Invoices management') }}">
                        <x-sidebar-elements.navlink link="{{ route('invoices') }}" text="{{ __('Invoices') }}" />
                    </x-sidebar-elements.treeview>
                @endcan

                @if (Auth::user()->can('product_show') || Auth::user()->can('category_show') || Auth::user()->can('stock_show') || Auth::user()->can('tag_show'))
                    <x-sidebar-elements.treeview fa-icon="fab fa-product-hunt" text="{{ __('Stock management') }}">
                        @can('product_show')
                            <x-sidebar-elements.navlink link="{{ route('products') }}" text="{{ __('Products') }}" />
                        @endcan
                        @can('category_show')
                            <x-sidebar-elements.navlink link="{{ route('categories') }}"
                                text="{{ __('Categories') }}" />
                        @endcan
                        @can('stock_show')
                            <x-sidebar-elements.navlink link="{{ route('stocks') }}" text="{{ __('Stocks') }}" />
                        @endcan
                        @can('tag_show')
                            <x-sidebar-elements.navlink link="{{ route('tags') }}" text="{{ __('Tags') }}" />
                        @endcan
                    </x-sidebar-elements.treeview>
                @endif

                @if (Auth::user()->can('project_show') || Auth::user()->can('field_show'))
                    <x-sidebar-elements.treeview fa-icon="fab fa-product-hunt"
                        text="{{ __('Projects management') }}">
                        @can('project_show')
                            <x-sidebar-elements.navlink link="{{ route('projects') }}" text="{{ __('projects') }}" />
                        @endcan
                        @can('field_show')
                            <x-sidebar-elements.navlink link="{{ route('fields') }}" text="{{ __('fields') }}" />
                        @endcan
                    </x-sidebar-elements.treeview>
                @endif
                @if (Auth::user()->can('user_show') || Auth::user()->can('role_show'))
                    <x-sidebar-elements.treeview fa-icon="fab fa-product-hunt" text="{{ __('Users management') }}">
                        @can('user_show')
                            <x-sidebar-elements.navlink link="{{ route('users') }}" text="{{ __('users') }}" />
                        @endcan
                        @can('role_show')
                            <x-sidebar-elements.navlink link="{{ route('roles') }}" text="{{ __('roles') }}" />
                        @endcan
                    </x-sidebar-elements.treeview>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
