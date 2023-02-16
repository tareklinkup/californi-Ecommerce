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
                <h4 class="card-title d-inline">Add New Category</h4>
                <a href="{{ route('admin.category.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label" for="parent_id">
                                Parent Id <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">--- Select ---</option>
                                @foreach ($categorys as $item)  
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Category Name <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="name" value="{{ old('name') }}" placeholder="Text" class="form-control @error('name') is-invalid @enderror">
                            <small class="form-text text-muted">Write new category name</small>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Thumbnail Image <span class="text-danger">*</span> </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="text-input" name="thumbnail_image" placeholder="Text" class="form-control-file @error('thumbnail_image') is-invalid @enderror">
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
                            <label class="mr-3"><input type="radio" name="status" value="1" checked> Active</label>
                            <label><input type="radio" name="status" value="0"> Inactive</label>
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
                                <i class="fa fa-dot-circle-o"></i> Submit
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
