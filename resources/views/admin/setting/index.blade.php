@extends('admin.admin_master')

@push('css')

@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Settings</h4>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Logo</th>
                                    <td>:</td>
                                    <td>
                                        @if ($settings->logo)
                                            <img src="{{ asset($settings->logo) }}" height="80" alt="">
                                        @endif
                                        <input type="file" name="logo" value="{{ $settings->logo }}" id="logo" class="form-control-file">
                                        @if ($errors->has('logo'))
                                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shop Name</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="shop_name" value="{{ $settings->shop_name }}" id="shop_name" class="form-control">
                                        @if ($errors->has('shop_name'))
                                            <span class="text-danger">{{ $errors->first('shop_name') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>:</td>
                                    <td>
                                        <textarea name="address" id="address" class="form-control">{{ $settings->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hotline</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="phone_1" id="phone_1" value="{{ $settings->phone_1 }}" class="form-control">
                                        @if ($errors->has('phone_1'))
                                            <span class="text-danger">{{ $errors->first('phone_1') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="phone_2" id="phone_2" value="{{ $settings->phone_2 }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email 1</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="email_1" id="email_1" value="{{ $settings->email_1 }}" class="form-control">
                                        @if ($errors->has('email_1'))
                                            <span class="text-danger">{{ $errors->first('email_1') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email 2</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="email_2" id="email_2" value="{{ $settings->email_2 }}" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
        
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>VAT (%)</th>
                                    <td>:</td>
                                    <td>
                                        <input type="number" name="vat" id="vat" step="0.01" value="{{ $settings->vat }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Shipping Charge (TK)</th>
                                    <td>:</td>
                                    <td>
                                        <input type="number" name="shipping_charge" id="shipping_charge" step="0.01" value="{{ $settings->shipping_charge }}" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Facebook URL</th>
                                    <td>:</td>
                                    <td>
                                        <textarea name="facebook" id="facebook" class="form-control">{{ $settings->facebook }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Twitter URL</th>
                                    <td>:</td>
                                    <td>
                                        <textarea name="twitter" id="twitter" class="form-control">{{ $settings->twitter }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Youtube URL</th>
                                    <td>:</td>
                                    <td>
                                        <textarea name="youtube" id="youtube" class="form-control">{{ $settings->youtube }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Vimeo URL</th>
                                    <td>:</td>
                                    <td>
                                        <textarea name="vimeo" id="vimeo" class="form-control">{{ $settings->vimeo }}</textarea>
                                    </td>
                                </tr>
                            </table>
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
