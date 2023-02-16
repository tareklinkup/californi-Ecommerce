@extends('layouts.master')

@push('css')
<style>
    .about {
        padding: 2em 0 5em !important;
    }
    .alert {
        margin-top: 10px;
        margin-bottom: -5px;
    }
    .w3_agileits_contact_grid_right textarea {
        font-weight: normal !important;
    }
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Contact Us</li>
        </ol>
    </div>
</div>

<div class="about">
    <div class="w3_agileits_contact_grids">
        <div class="col-sm-8 w3_agileits_contact_grid_left">
            <div class="agile_map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.347557401516!2d90.36727251445694!3d23.80623699255902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c12c75554429%3A0x673e570e4bfdb4a0!2zRmFudGFzeSBHYW1laG91c2UgJiBGaXRuZXNzIOCmq-CnjeCmr-CmvuCmqOCnjeCmn-CmvuCmuOCmvyDgppbgp4fgprLgpr7gppjgprAg4KaP4Kao4KeN4KahIOCmq-Cmv-Cmn-CmqOCnh-CmuA!5e0!3m2!1sbn!2sbd!4v1581313239942!5m2!1sbn!2sbd" style="border:0;" allowfullscreen=""></iframe>
            </div>
            
        </div>
        <div class="col-sm-4 w3_agileits_contact_grid_right">
           
            <div class="agileits_w3layouts_map_pos">
                <div class="agileits_w3layouts_map_pos1">
                    <h3>Contact Info</h3>
                    <p>{{ $_settings->address }}</p>
                    <ul class="wthree_contact_info_address">
                        <li class="d-flex">
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <a href="mailto:{{ $_settings->email_1 }}">{{ $_settings->email_1 }}</a>
                        </li>
                        <li class="d-flex">
                            <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <a href="mailto:{{ $_settings->phone_1 }}">{{ $_settings->phone_1 }}</a>
                        </li>
                    </ul>
                    <div class="w3_agile_social_icons w3_agile_social_icons_contact">
                        <ul>
                            @if ($_settings->facebook)
                            <li><a href="{{ $_settings->facebook }}" target="_blank" class="icon icon-cube agile_facebook"></a></li>
                            @endif
                            @if ($_settings->youtube)
                            <li><a href="{{ $_settings->youtube }}" target="_blank" class="custom-icon red"><i class="fa fa-youtube-play"></i></a></li>
                            @endif
                            @if ($_settings->twitter)
                            <li><a href="{{ $_settings->twitter }}" target="_blank" class="icon icon-cube agile_t"></a></li>
                            @endif
                            @if ($_settings->vimeo)
                            <li><a href="{{ $_settings->vimeo }}" target="_blank" class="custom-icon"><i class="fa fa-vimeo"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection


@push('js')
    
@endpush
