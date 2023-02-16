@extends('admin.admin_master')

@push('css')

@endpush

@section('content')
<div class="row">

    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Product</h4>
                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info btn-sm float-right">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.product.index') }}" class="btn btn-dark btn-sm float-right mr-2">Back</a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td>Product Code</td>
                                <td>:</td>
                                <td>{{ $product->product_code }}</td>
                            </tr>
                            <tr>
                                <td>Product Name</td>
                                <td>:</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td>:</td>
                                <td>{{ optional($product->brand)->name }}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>:</td>
                                <td>{{ optional($product->category)->name }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    @if ($product->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td>Quantity</td>
                                <td>:</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>:</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <td>Discount Amount</td>
                                <td>:</td>
                                <td>{{ $product->discount_amount }}</td>
                            </tr>
                            <tr>
                                <td>Discount Percent</td>
                                <td>:</td>
                                <td>{{ $product->discount_percent }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Is Featured</td>
                                <td>:</td>
                                <td>
                                    @if ($product->is_featured)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                    @endif
                                </td>
                            </tr> --}}
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Product Image</h6>
                        <img src="{{ asset($product->thumbnail) }}" class="mb-2" alt=""> <br>
                        @if ($product->images->count())
                            @foreach ($product->images as $image)
                                <img src="{{ asset($image->image) }}" class="m-3" height="80" alt="">
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-2">Product Description</h6>
                        {!! $product->description !!}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
