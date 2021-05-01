<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Product;

class ImportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barang = Product::all();
        $categories = Categories::all();
        $brands = Brands::all();
        return view('masuk', compact('user', 'barang', 'categories', 'brands'));
    }
}
