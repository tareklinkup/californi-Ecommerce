@extends('admin.admin_master')

@section('breadcrumb')

@endsection

@section('content')


<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-users"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Users</div>
                    <div class="stat-digit">{{ $user_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-grid2 text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Brands</div>
                    <div class="stat-digit">{{ $brand_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Categories</div>
                    <div class="stat-digit">{{ $category_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-list-ol text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Products</div>
                    <div class="stat-digit">{{ $product_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-list-ol text-warning border-warning"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">New Orders</div>
                    <div class="stat-digit">{{ $new_order_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-list text-danger border-danger"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Processing Orders</div>
                    <div class="stat-digit">{{ $processing_order_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Complete Orders</div>
                    <div class="stat-digit">{{ $complete_order_count }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
