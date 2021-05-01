<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('home', compact('user'));
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'Laporan.xlsx');
    }

    public function import(Request $req)
    {
        Excel::import(new ProductImport, $req->file('file'));

        $notification = array(
            'message' => 'Import data berhasil dilakukan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }
}
