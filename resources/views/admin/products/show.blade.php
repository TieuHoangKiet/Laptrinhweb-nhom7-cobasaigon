@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Product Details: {{ $product->name }}</h1>
            <div class="card">
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $product->id }}</p>
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> {{ number_format($product->price, 2) }} VND</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Image:</strong></p>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                    @else
                        <p>No Image</p>
                    @endif
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-2">Back to List</a>
        </div>
    </div>
</div>
@endsection