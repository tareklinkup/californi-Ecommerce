@extends('admin.admin_master')

@push('css')

@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Banners</h4>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <p>
                    <span class="text-danger">Warning : </span> 
                    <span class="text-dark">Image width 230px and height 180px</span> 
                </p>

                <form action="{{ route('admin.banners.update') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" for="banner_1">Banner 1</label>
                                @if ($settings->banner_1)
                                    <p><img src="{{ asset($settings->banner_1) }}" height="180" width="230" alt=""></p>
                                @endif
                                <input type="file" name="banner_1" id="banner_1" class="form-control-file">
                                @if ($errors->has('banner_1'))
                                    <span class="text-danger">{{ $errors->first('banner_1') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" for="banner_2">Banner 2</label>
                                @if ($settings->banner_2)
                                    <p><img src="{{ asset($settings->banner_2) }}" height="180" width="230" alt=""></p>
                                @endif
                                <input type="file" name="banner_2" id="banner_2" class="form-control-file">
                                @if ($errors->has('banner_2'))
                                    <span class="text-danger">{{ $errors->first('banner_2') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" for="banner_3">Banner 3</label>
                                @if ($settings->banner_3)
                                    <p><img src="{{ asset($settings->banner_3) }}" height="180" width="230" alt=""></p>
                                @endif
                                <input type="file" name="banner_3" id="banner_3" class="form-control-file">
                                @if ($errors->has('banner_3'))
                                    <span class="text-danger">{{ $errors->first('banner_3') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold" for="banner_4">Banner 4</label>
                                @if ($settings->banner_4)
                                    <p><img src="{{ asset($settings->banner_4) }}" height="180" width="230" alt=""></p>
                                @endif
                                <input type="file" name="banner_4" id="banner_4" class="form-control-file">
                                @if ($errors->has('banner_4'))
                                    <span class="text-danger">{{ $errors->first('banner_4') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <input type="submit" value="Update" class="btn btn-info btn-block">
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
