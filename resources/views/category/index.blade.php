@extends('layout.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="my-5 col-8 mx-auto">
                <a href="{{ route('category.create') }}" class="btn btn-primary">Add category</a>
            </div>
            <div class="col-8 mx-auto">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">options</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('category.show', $category->id) }}">show</a>
                                    <a href="{{ route('category.edit', $category->id) }}">edit</a>
                           
                                    {{-- <a href="{{ route('category.delete', $category->id) }}">delete</a> --}}
                                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" name="delete" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">there is no records on categories table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
