@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">{{ $product->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Product Image -->
        <div class="bg-white rounded-lg shadow">
            <a href="{{ route('products.show', $product->id) }}">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded-t-lg w-full h-auto max-h-64 object-contain">
                @else
                    <img src="https://via.placeholder.com/150" alt="{{ $product->name }}" class="rounded-t-lg w-full h-auto max-h-64 object-contain">
                @endif
            </a>
        </div>

        <!-- Product Details -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Description</h3>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
            <h4 class="text-lg font-bold text-blue-600 mb-2">Price: ${{ $product->price }}</h4>
            <h5 class="text-md text-gray-600">Category: {{ $product->category->name }}</h5>
            <a href="{{ route('buy', ['product' => $product->id]) }}" class="mt-6 inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
                <i class="fas fa-cart-plus mr-2"></i> Buy
            </a>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="mt-8 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
        Back to Dashboard
    </a>

    <hr class="my-8 border-gray-300">

    <!-- Related Products -->
    <h2 class="text-2xl font-bold mb-6">Related Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow hover:shadow-lg">
                <a href="{{ route('products.show', $relatedProduct->id) }}">
                    <img src="{{ asset('storage/' . $relatedProduct->image_path) }}" alt="{{ $relatedProduct->name }}" class="rounded-t-lg w-full h-auto max-h-40 object-contain">
                </a>
                <div class="p-4">
                    <h5 class="text-lg font-semibold text-gray-800 truncate">{{ $relatedProduct->name }}</h5>
                    <p class="text-sm text-gray-600 truncate">{{ $relatedProduct->description }}</p>
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="mt-4 inline-block text-blue-600 hover:underline text-sm">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
