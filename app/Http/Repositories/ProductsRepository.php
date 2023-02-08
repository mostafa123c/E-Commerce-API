<?php

namespace App\Http\Repositories;

use App\Exports\Productsexport;
use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\ProductsInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\Productsimport;
use App\Models\product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductsRepository implements ProductsInterface
{
    use ApiResponseTrait;


    public function products()
    {
        $products = product::get();
        return $this->apiResponse(200,'products' ,null,$products);
    }

    public function productsform()
    {
        return view('products');
    }

    public function uploadproducts($request)
    {
        Excel::import(new Productsimport, $request->file );
        return redirect('/products')->with('success', 'All good!');
    }

    public function downloadproducts()
    {
        return Excel::download(new Productsexport() , 'test.xlsx');
    }
}
