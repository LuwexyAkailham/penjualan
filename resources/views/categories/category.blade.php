@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Category: {{ $category->name }}</h1>

    <!-- Display Products in this Category -->
    <div class="row">
        @if($products->isEmpty())
            <p>No products available in this category.</p>
        @else
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
