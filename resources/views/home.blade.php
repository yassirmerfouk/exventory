<x-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="row">
                    @can('product_show')
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $products_count }}</h3>

                                    <p>Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                <a href="{{ route('products') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endcan
                    @can('product_show')
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $quantity_count }}</h3>

                                    <p>Products quantity</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                <a href="{{ route('stocks') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endcan
                    @can('project_show')
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $projects_count }}</h3>

                                    <p>Projects</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-project-diagram"></i>
                                </div>
                                <a href="{{ route('projects') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endcan
                    @can('user_show')
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $users_count }}</h3>

                                    <p>Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="{{ route('users') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

</x-layout>
