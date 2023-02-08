<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductsInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public $productsinterface;
   public function __construct(ProductsInterface $productsinterface)
   {
       $this->productsinterface = $productsinterface;
   }

   public function products()
   {
       return $this->productsinterface->products();
   }

    public function productsform()
    {
        return $this->productsinterface->productsform();
    }
    public function uploadproducts(Request $request)
    {
        return $this->productsinterface->uploadproducts($request);
    }

    public function downloadproducts()
    {
        return $this->productsinterface->downloadproducts();
    }
}
