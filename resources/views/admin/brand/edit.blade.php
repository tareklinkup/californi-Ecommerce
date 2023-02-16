@extends('admin.admin_master')

@push('css')
<style>
label { margin-bottom: 0 !important; }
</style> 
@endpush

@section('content')
<div class="row">

    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Edit Brand</h4>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Brand Name <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="name" value="{{ $brand->name }}" placeholder="Text" class="form-control @error('name') is-invalid @enderror">
                            <small class="form-text text-muted">Write new brand name</small>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Thumbnail Image </label>
                        </div>
                        <div class="col-12 col-md-9">
                            @if (file_exists($brand->thumbnail))
                                <img src="{{ asset($brand->thumbnail) }}" height="50" class="mb-2">
                            @endif
                            <input type="file" id="text-input" name="thumbnail_image" placeholder="Text" class="form-control-file @error('name') is-invalid @enderror">
                            <small class="form-text text-danger">Image height 162px and minimum width 220px.</small>
                            @if ($errors->has('thumbnail_image'))
                                <span class="text-danger">{{ $errors->first('thumbnail_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Status <span class="text-danger">*</span> </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <label class="mr-3"><input type="radio" name="status" value="1" {{ $brand->status ? 'checked' : '' }}> Active</label>
                            <label><input type="radio" name="status" value="0" {{ $brand->status == 0 ? 'checked' : '' }}> Inactive</label>
                            <small class="form-text text-muted">Choose a publication status</small>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
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

@endpush
