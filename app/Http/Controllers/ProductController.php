<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Product;



class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barang = Product::all();
        $categories = Categories::all();
        $brands = Brands::all();
        return view('products', compact('user', 'barang', 'categories', 'brands'));
    }

    public function add_product(Request $req)
    {

        $barang = new Product;

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->qty = $req->get('qty');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_barang_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_barang',
                $filename
            );

            $barang->photo = $filename;
            $barang->save();

            $notification = array(
                'message' => 'Data Barang Berhasil Ditambahkan',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.product')->with($notification);
        }
    }
}
