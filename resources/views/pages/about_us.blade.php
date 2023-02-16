@extends('layouts.master')

@push('css')
<style>

</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">About Us</li>
        </ol>
    </div>
</div>

<div class="container">

    <div class="about-us">
        @foreach ($about_us as $about)
            <h2 class="about-us-heading">
                <span>{{ $about->heading }}</span>
            </h2>
            @if ($about->is_column == 0)
                <div class="p-15px">
                    @if ($about->banner)
                        <img src="{{ asset($about->banner) }}" class="img-responsive about-img" alt="">
                    @endif
                    <div class="about-us-desc">
                        {!! $about->description !!}
                    </div>
                </div>
            @else
                <div class="about-us-desc">
                    @if ($loop->iteration % 2 == 0)
                        <div class="col-md-6">
                            <img src="{{ asset($about->banner) }}" class="img-responsive col-about-img" alt="">
                        </div>
                        <div class="col-md-6">
                            {!! $about->description !!}
                        </div>
                    @else
                        <div class="col-md-6">
                            {!! $about->description !!}
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset($about->banner) }}" class="img-responsive col-about-img" alt="">
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            @endif
        @endforeach
    </div>

</div>

@endsection


@push('js')
    
@endpush
