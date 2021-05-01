<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'nama' => $row[0],
            'categories_id' => $row[1],
            'brands_id' => $row[2],
            'harga' => $row[3],
            'qty' => $row[4],
        ]);
    }
}
