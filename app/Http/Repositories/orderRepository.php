<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\orderInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use App\Rules\CartStockValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class orderRepository implements orderInterface
{
    use ApiResponseTrait;


    public function checkout($request)
    {
        $validation =Validator::make($request->header() ,
            [
                'authorization' => new CartStockValidation(),
            ]
        );
        if ($validation->fails()){
            return  $this->apiResponse(400 , 'Validation error' ,$validation->errors() );
        }


        $cartitems = Cart::where('user_id' , auth()->user()->id)->with('product')->get();

        $totalprice = $cartitems->sum(function($item){
            return $item->count * $item->product->price;
        });


        DB::transaction(function () use ($totalprice , $cartitems){

            $order = Order::create([
                'user_id' => auth()->user()->id ,
                'total_price' => $totalprice
            ]);


            foreach ($cartitems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'count' => $cartItem->count,
                    'unit_price' => $cartItem->product->price,
                    'net_price' => $cartItem->count * $cartItem->product->price
                ]);
                //update stock
                $product =Product::find($cartItem->product_id);
                $product->update(['stock' => $product->stock - $cartItem->count]);

                //Delete from cart
                $cartItem->delete();
            }
        });

        return $this->apiResponse(200, 'order was created');

    }
}
