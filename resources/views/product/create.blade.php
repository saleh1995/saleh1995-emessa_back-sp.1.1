@extends('layout.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="my-5">Add a product</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="post" action="{{ route('product.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">name</label>
                        <input type="text" class="form-control" name='name' value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">category</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">price</label>
                        <input type="text" class="form-control" name='price' value="{{ old('price') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">description</label>
                        <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>

                    


                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
