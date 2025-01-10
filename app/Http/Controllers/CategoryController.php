<?php

namespace App\Http\Controllers;

use App\Models\Category; // Model Category
use App\Models\Product;  // Model Product
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategory($id)
    {
        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Ambil semua produk berdasarkan kategori ID
        $products = Product::where('category_id', $id)->get();

        // Tampilkan view dengan data kategori dan produk
        return view('categories.category', compact('category', 'products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Get all categories to pass to the view
        $categories = Category::all();
    
        // Perform the search query
        $products = Product::where('name', 'like', '%' . $query . '%')
                           ->orWhere('description', 'like', '%' . $query . '%')
                           ->orWhereHas('category', function($q) use ($query) {
                               $q->where('name', 'like', '%' . $query . '%');
                           })
                           ->get();
    
        // Return the view with both products and categories
        return view('product.product', compact('products', 'categories'));
    }
    
    // Tambahkan metode CRUD lainnya jika diperlukan
}
