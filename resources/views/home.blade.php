@extends('layout.master')

@section('content')
    @php
        $hi = 'hiiiiiiiiiiiiii';
    @endphp
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $name }}</h5>
            @if ($bool == true)
                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $age }}</h6>
            @endif
            <p class="card-text">MVC on prouducts</p>
            <a href="" class="card-link">@php
                echo $hi;
            @endphp</a>
            {{-- {{ $tag }} --}}
            {!! $tag !!}
        </div>
    </div>
@endsection

{{-- @section('title')
    home
@endsection --}}
