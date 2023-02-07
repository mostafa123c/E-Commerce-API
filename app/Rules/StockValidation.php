<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StockValidation implements Rule
{
    public $productid;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productid)
    {
       $this->productid = $productid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //$this->product_id || request('product_id') (2 ways)
        $product= product::where([  ['id' , $this->productid], ['stock' , '>=' , $value ] ])->first();
       if($product)
       {
           $cart = Cart::where([ ['user_id' , Auth::user()->id] , ['product_id' , $product->id] ])->first();

           if($cart)
           {
               if($cart->count + $value <= $product->stock)
               {
                   return true;
               }
               return false;
           }
           return true;
       }

       return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Stock Not found.';
    }
}
