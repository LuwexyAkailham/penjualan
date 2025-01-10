@extends('layouts.main')

@section('content')
    <div class="container mx-auto mt-8 p-6 max-w-md bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-4">Payment for {{ $product->name }}</h1>
        <h4 class="text-xl text-center text-gray-600 mb-6">Price: ${{ $product->price }}</h4>

        <!-- Product Image -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-lg shadow-lg">
        </div>

        <!-- Payment form -->
        <form action="{{ route('pay', ['product' => $product->id]) }}" method="POST">
            @csrf

            <!-- Payment amount input -->
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Enter Payment Amount:</label>
                <input 
                    type="number" 
                    name="amount" 
                    id="amount" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" 
                    required 
                    min="0" 
                    step="any" 
                    placeholder="Enter amount to pay">
            </div>

            <!-- Submit button -->
            <button 
                type="submit" 
                class="w-full py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition duration-200">
                Complete Payment
            </button>
        </form>
    </div>
@endsection
