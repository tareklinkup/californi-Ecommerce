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
                <h4 class="card-title d-inline">About Us - New Section</h4>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-dark btn-sm float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.us.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Heading <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="heading" name="heading" value="{{ old('heading') }}" placeholder="Text" class="form-control @error('heading') is-invalid @enderror">
                            <small class="form-text text-muted">Write heading</small>
                            @if ($errors->has('heading'))
                                <span class="text-danger">{{ $errors->first('heading') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Banner Image </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="banner" name="banner" placeholder="Text" class="form-control-file @error('banner') is-invalid @enderror">
                            <small class="form-text text-muted">Choose a banner image</small>
                            @if ($errors->has('banner'))
                                <span class="text-danger">{{ $errors->first('banner') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Description <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">Write description</small>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group" id="is_column_wrapper" style="display:none">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Is Column <span class="text-danger">*</span> </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <label class="mr-3"><input type="radio" name="is_column" value="1"> Yes</label>
                            <label><input type="radio" name="is_column" value="0" checked> No</label>
                            @if ($errors->has('is_column'))
                                <span class="text-danger">{{ $errors->first('is_column') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" id="reset" class="btn btn-danger btn-sm">
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

    (function($) {
        $(document).on('change', '#banner', function() {
            $('#is_column_wrapper').show();
        });
        $(document).on('click', '#reset', function() {
            $('#is_column_wrapper').hide();
        });
    })(jQuery);
</script>
@endpush
