@extends('admin.admin_master')

@push('css')
<style>
label { margin-bottom: 0 !important; }
</style> 
@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Edit Product</h4>
                <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm float-right">
                   <i class="fa fa-eye"></i> Show
                </a>
                <a href="{{ route('admin.product.index') }}" class="btn btn-dark btn-sm float-right mr-2">Back</a>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Product Code </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text"  name="product_code" value="{{ $product->product_code }}" placeholder="Text" class="form-control @error('product_code') is-invalid @enderror">
                                    <small class="form-text text-muted">Write new product code</small>
                                    @if ($errors->has('product_code'))
                                        <span class="text-danger">{{ $errors->first('product_code') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">
                                        Product Name <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text"  name="name" value="{{ $product->name }}" placeholder="Text" class="form-control @error('name') is-invalid @enderror">
                                    <small class="form-text text-muted">Write new product name</small>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">
                                        Brand <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror">
                                        <option value="" hidden>--- Select Brand ---</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select product brand</small>
                                    @if ($errors->has('brand'))
                                        <span class="text-danger">{{ $errors->first('brand') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">
                                        Category <span class="text-danger">*</span>
                                    </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="" hidden>--- Select Category ---</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select product category</small>
                                    @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Thumbnail Image <span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    @if (file_exists($product->thumbnail))
                                        <img src="{{ asset($product->thumbnail) }}" height="80" class="mb-2" alt="">
                                    @endif
                                    <input type="file" name="thumbnail_image" placeholder="Text" class="form-control-file @error('thumbnail_image') is-invalid @enderror">
                                    <small class="form-text text-danger">Image height 162px and width 220px.</small>
                                    @if ($errors->has('thumbnail_image'))
                                        <span class="text-danger">{{ $errors->first('thumbnail_image') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Stock Quantity </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number"  name="quantity" value="{{ $product->quantity }}" placeholder="Number" class="form-control @error('quantity') is-invalid @enderror">
                                    <small class="form-text text-muted">Write product stock quantity</small>
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Price <span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number"  name="price" value="{{ $product->price }}" placeholder="Number" class="form-control @error('price') is-invalid @enderror">
                                    <small class="form-text text-muted">Write product price</small>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Discount </label>
                                </div>
                                <div class="col-12 col-md-9">

                                    @if (session('discount_error'))
                                        <span class="text-danger mb-2 d-block">{{ session('discount_error') }}</span>
                                    @endif

                                    <input type="number" name="discount_amount" id="discount_amount" value="{{ $product->discount_amount }}" {{$product->discount_percent ? 'style=display:none': ''}} class="form-control {{ session('discount_error') ? 'is-invalid' : '' }}" placeholder="Amount">
                                    
                                    <div class="input-group mt-2" id="discount_percent_wrap" {{$product->discount_amount ? 'style=display:none': ''}}>
                                        <input type="number" name="discount_percent" id="discount_percent" value="{{ $product->discount_percent }}" placeholder="Percent" class="form-control {{ session('discount_error') ? 'is-invalid' : '' }}">
                                        <div class="input-group-prepend"> <div class="input-group-text"> % </div> </div>
                                    </div> 
                              
                                    <small class="form-text text-muted">Write product discount amount or percent</small>
                                    @if ($errors->has('discount_amount'))
                                        <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                                    @elseif ($errors->has('discount_percent'))
                                        <span class="text-danger">{{ $errors->first('discount_percent') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Is Featured <span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label class="mr-3"><input type="radio" name="featured" value="1" {{ $product->is_featured ? 'checked' : '' }}> Yes</label>
                                    <label><input type="radio" name="featured" value="0" {{ $product->is_featured == 0 ? 'checked' : '' }}> No</label>
                                    <small class="form-text text-muted">Choose featured status</small>
                                    @if ($errors->has('featured'))
                                        <span class="text-danger">{{ $errors->first('featured') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"> Status <span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label class="mr-3"><input type="radio" name="status" value="1" {{ $product->status ? 'checked' : '' }}> Active</label>
                                    <label><input type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}> Inactive</label>
                                    <small class="form-text text-muted">Choose a publication status</small>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label"> Images </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    @foreach ($product->images as $image)
                                    <div class="img-wrapper">
                                        <img src="{{ asset($image->image) }}" height="80" class="border" alt="">
                                        <button type="button" data-img_id="{{ $image->id }}" class="img-del-btn"> <i class="fa fa-times"></i> </button>
                                    </div>
                                    @endforeach
                                    <input type="file" name="image[]" multiple class="form-control-file">
                                    @if (count($errors->get('image.*')))
                                        @for ($i = 0; $i < count($errors->get('image.*')); $i++)
                                            @error('image.' . $i)
                                                <span class="text-danger d-block">{{ str_replace('.', ' ', $message) }}</span>
                                            @enderror
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Description <span class="text-danger">*</span> </label>
                        </div>
                        <div class="col-12 col-md-9">
                            @if ($errors->has('description'))
                                <span class="text-danger mb-2 d-block">{{ $errors->first('description') }}</span>
                            @endif
                            <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.ckeditor.com/4.13.1/basic/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
    
    (function ($) {

        var discount_amount = $('#discount_amount');
        var discount_percent = $('#discount_percent');
        var discount_percent_wrap = $('#discount_percent_wrap');

        $(document).on('keyup change focusout', '#discount_amount', function () {
            if ('' != discount_amount.val()) {
                discount_percent.val('')
                discount_percent_wrap.hide();
            } else {
                discount_percent.val('')
                discount_percent_wrap.show();
            }
            clearDiscount();
        });

        $(document).on('keyup change focusout', '#discount_percent', function () {
            if ('' != discount_percent.val()) {
                discount_amount.val('').hide();
            } else {
                discount_amount.val('').show();
            }
            clearDiscount();
        });

        $(document).on('click', '.img-del-btn', function() {
            if (confirm('Are you sure?') && '' != $(this).data('img_id')) {
                var route = '{{ route('admin.product.image.delete', ':id') }}';
                var _url = route.replace(':id', $(this).data('img_id'));
                $.ajax({
                    url: _url,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $(this).closest('.img-wrapper').remove();
                        }
                    }.bind(this)
                });
            }
        });
    })(jQuery);

    function clearDiscount() {
        if ('' != discount_amount.val() && '' != discount_percent.val()) {
            discount_percent.val('')
            discount_percent_wrap.show();
            discount_amount.val('').show();
        }
    }
</script>
@endpush
