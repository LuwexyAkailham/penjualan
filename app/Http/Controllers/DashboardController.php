<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product ada
use App\Models\Category;
class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data produk dari database
        $products = Product::all();

        // Kirim data produk ke view
        return view('dashboard.dashboard', compact('products'));
    }

    // Controller Method
public function dashboard()
{
    // Ambil semua kategori dari database
    $categories = Category::all();

    // Kirim data ke view
    return view('dashboard', compact('categories'));
}

}
