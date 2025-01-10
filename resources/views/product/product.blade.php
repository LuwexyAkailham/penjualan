@extends('layouts.main')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Tambah Products</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul class="list-disc ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Product Form -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-700 font-medium">Product Name</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>
        <div>
            <label for="description" class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required></textarea>
        </div>
        <div>
            <label for="price" class="block text-gray-700 font-medium">Price</label>
            <input type="number" name="price" id="price" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
        </div>
        <div>
            <label for="category" class="block text-gray-700 font-medium">Category</label>
            <select name="category_id" id="category" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image" class="block text-gray-700 font-medium">Product Image</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Add Product</button>
    </form>

    <!-- Display Products -->
    <h2 class="text-2xl font-bold mt-10 mb-6">Your Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Gambar produk -->
                <a href="{{ route('products.show', $product->id) }}">
                    <div class="relative w-full h-48">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/150" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </a>

                <!-- Deskripsi dan harga produk -->
                <div class="p-4">
                    <h5 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h5>
                    <p class="text-sm text-gray-600 truncate">{{ $product->description }}</p>
                    <p class="text-blue-600 font-bold mt-2">${{ $product->price }}</p>

                    <!-- Tombol Edit dan Delete -->
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 transition">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
