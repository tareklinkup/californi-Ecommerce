@extends('layouts.master')

@push('css')

@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Categories</li>
        </ol>
    </div>
</div>

<div class="container">

    @php($fc = 0)

    @foreach ($categories as $category)

        @if ($fc == 4)
            <div class="clearfix"></div>
            @php($fc = 0)
        @endif

        @php($fc++)

        <div class="col-md-3">
            <a href="{{ route('category.products', $category->slug) }}">
                <div class="panel panel-default my_panel">
                    <div class="panel-body">
                        <img src="{{ asset($category->thumbnail) }}" alt="" class="img-responsive center-block" />
                        <h4 class="category-name">{{ $category->name }}</h4>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection


@push('js')

@endpush
