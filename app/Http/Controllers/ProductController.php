<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Get all categories from the categories table
        $categories = Category::all();

        // Get products belonging to the logged-in user
        $products = Product::where('user_id', Auth::id())->get(); 

        // Send products and categories to the view
        return view('product.product', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Store product in the database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function show($id)
{
    $product = Product::findOrFail($id);

    // Ambil produk lain dengan kategori yang sama, kecuali produk yang sedang ditampilkan
    $relatedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id)
                              ->take(4) // Batasi jumlah produk yang ditampilkan
                              ->get();

    return view('product.show', compact('product', 'relatedProducts'));
}

    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        
        // Get all categories to display in the edit form
        $categories = Category::all();

        // Return the edit view with the product and categories data
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if exists
        $imagePath = $product->image_path;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Update the product in the database
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
        ]);

        // Redirect back to the product list with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Ensure the product belongs to the authenticated user
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')->withErrors('You are not authorized to delete this product.');
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function buy($productId)
    {
        $product = Product::findOrFail($productId);
        // Add your purchase logic here (e.g., add to cart, process payment, etc.)
        
        return redirect()->route('dashboard')->with('success', 'Product added to cart!');
    }

    public function showPaymentPage($productId)
    {
        $product = Product::findOrFail($productId);
        
        return view('payment', compact('product'));
    }

    public function processPayment(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $paymentAmount = $request->input('amount');

        // Check if the payment is less than the product price
        if ($paymentAmount < $product->price) {
            return redirect()->route('dashboard')->with('error', 'Payment is insufficient. Please enter a valid amount.');
        }

        // Calculate change if payment is more than the product price
        $change = $paymentAmount - $product->price;

        // If payment is successful, delete the product and return success message
        $product->delete();

        // Check if there's any change to return
        if ($change > 0) {
            return redirect()->route('dashboard')->with('success', 'Payment successful! Your change is $' . number_format($change, 2));
        }

        return redirect()->route('dashboard')->with('success', 'Payment successful! Thank you for your purchase.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')
                           ->orWhere('description', 'like', '%' . $query . '%')
                           ->orWhereHas('category', function($q) use ($query) {
                               $q->where('name', 'like', '%' . $query . '%');
                           })
                           ->get();

        return view('product.product', compact('products'));
    }
}
