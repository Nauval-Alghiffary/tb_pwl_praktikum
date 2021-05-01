<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements FromArray, WithHeadings, ShouldAutosize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return Product::getDataProduct();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Kategori',
            'Merek',
            'Harga',
            'Stok'
        ];
    }
    
}
