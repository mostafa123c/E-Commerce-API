<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
        ['product1',100,10],
        ['product2',200,15],
        ['product3',300,17],
        ['product4',400,19],
        ['product5',500,20],
    ];
        foreach ($products as $product)
        {
            product::create([
                'name'=>$product[0],
                'price'=>$product[1],
                'stock'=>$product[2]
                ]);
        }
    }
}
