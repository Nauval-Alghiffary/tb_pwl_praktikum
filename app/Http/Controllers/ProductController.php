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
        $barang->harga = $req->get('harga');

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
        //proses ajax
        public function getDataProduct($id)
        {
            $product = Product::find($id);
    
            return response()->json($product);
        }

        public function update_product(Request $req)
        {
            $products = Product::find($req->get('id'));
    
            $products->name = $req->get('name');
            $products->categories_id = $req->get('categories_id');
            $products->brands_id = $req->get('brands_id');
            $products->harga = $req->get('harga');
            $products->qty = $req->get('qty');
    
            if ($req->hasFile('photo')) {
                $extension = $req->file('photo')->extension();
    
                $filename = 'photo_user_' . time() . '.' . $extension;
    
                $req->file('photo')->storeAs(
                    'public/photo_user',
                    $filename
                );
    
                Storage::delete('public/photo_product/' . $req->get('old_photo'));
    
                $products->photo = $filename;
            }
    
            $products->save();
    
            $notification = array(
                'message' => 'Edit Data Berhasil',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.product')->with($notification);
        }



    public function delete_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        Storage::delete('public/photo/'.$req->get('old-photo'));

        $product->delete();

        $notification = array(
            'message' => 'Hapus Data product Sukses',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }
}

