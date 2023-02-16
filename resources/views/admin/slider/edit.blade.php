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
                <h4 class="card-title d-inline">Slider - Edit Image</h4>
                <a href="{{ route('admin.sliders') }}" class="btn btn-dark btn-sm float-right">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <input type="hidden" name="id" value="{{ $slider->id }}">

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label"> Image </label>
                        </div>
                        <div class="col-12 col-md-9">
                            @if ($slider->image)
                                <img src="{{ asset($slider->image) }}" height="80" class="mb-2" alt="">
                            @endif
                            <input type="file" id="image" name="image" placeholder="Text" class="form-control-file @error('image') is-invalid @enderror">
                            <small class="form-text text-danger">
                                First Slider image height 500px and width 1280px.
                            </small>                            
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group" id="slider-heading">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Heading <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="heading" name="heading" value="{{ $slider->heading }}" placeholder="Text" class="form-control @error('heading') is-invalid @enderror">
                            <small class="form-text text-muted">Write heading</small>
                            @if ($errors->has('heading'))
                                <span class="text-danger">{{ $errors->first('heading') }}</span>
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
<script>
    (function($) {

        
    })(jQuery);
</script>
@endpush
