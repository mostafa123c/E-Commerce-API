<?php

namespace App\Http\Interfaces;

interface ProductsInterface
{
    public function products();
    public function productsform();
    public function uploadproducts($request);
    public function downloadproducts();

}
