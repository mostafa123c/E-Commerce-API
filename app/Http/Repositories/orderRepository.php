<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\orderInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
class orderRepository implements orderInterface
{
    use ApiResponseTrait;


    public function checkout()
    {
        $cartitems = Cart::where('user_id' , auth()->user()->id)->get();
        dd($cartitems);
    }
}
