@extends('layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="show-product">
        {{$product["title"]}}
    </div>
@endsection