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
                <h4 class="card-title d-inline">Edit Admin Info</h4>
            </div>
            <div class="card-body">

                @if (session('message'))
                    {!! session('message') !!}
                @endif

                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Username <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="username" value="{{ $admin->username }}" placeholder="Text" class="form-control @error('username') is-invalid @enderror">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Old Password
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" name="old_password" placeholder="Text" class="form-control @error('old_password') is-invalid @enderror">
                            @if (session('old_password'))
                                <span class="text-danger">{{ session('old_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                New Password
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" name="new_password" placeholder="Text" class="form-control @error('new_password') is-invalid @enderror">
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">
                                Confirm Password
                            </label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" name="confirm_password" placeholder="Text" class="form-control @error('confirm_password') is-invalid @enderror">
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
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
