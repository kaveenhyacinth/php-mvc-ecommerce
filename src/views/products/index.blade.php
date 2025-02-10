@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <div>
        <h1>All Products</h1>
        <ul>
            @foreach($products as $product)
                <li>{{$product['title']}}</li>
            @endforeach

        </ul>
    </div>
@endsection
