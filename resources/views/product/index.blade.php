@extends('layout.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">price</th>
                            <th scope="col">description</th>
                            <th scope="col">options</th>
                        </tr>
                    </thead>
                    <tbody>
                      <!--
                        @if (!$products->empty())
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="#">edit</a>
                                        {{-- <a href="{{ url('/product/delete') . '/' . $product->id }}">delete</a> --}}
                                        <a href="{{ route('product.delete', $product->id) }}">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                              <td colspan="100">there is no records on products table</td>
                            </tr>
                        @endif
                          -->
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="#">edit</a>
                                    {{-- <a href="{{ url('/product/delete') . '/' . $product->id }}">delete</a> --}}
                                    <a href="{{ route('product.delete', $product->id) }}">delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">there is no records on products table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
