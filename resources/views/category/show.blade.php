@extends('layout.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="my-5">show category details</h1>

                <div>
                    name : {{ $category->name }}
                </div>
                <div>
                    description : {{ $category->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
