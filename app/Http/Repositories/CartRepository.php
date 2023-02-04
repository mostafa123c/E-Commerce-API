<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\CartInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Rules\StockValidation;
use App\Rules\UpdateCartValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartRepository implements CartInterface
{
    use ApiResponseTrait;


    public function addtocart($request)
    {
        $validations =  Validator::make($request->all() , [
            'product_id' => 'required:exists:products,id',
            'count' => ['required' , new StockValidation($request->product_id)]
        ]);

        if($validations->fails())
        {
            return $this->apiResponse(400,'validation error' , $validations->errors());
        }
        //when adding the same product , so count updated
        $cart = Cart::where([ ['user_id' , Auth::user()->id], ['product_id' , $request->product_id] ])->first();

        if($cart)
        {
            $cart->update([
                'count' => $cart->count + $request->count
            ]);
        }
        else
        {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request ->product_id,
                'count' => $request->count
            ]);
        }


        return $this->apiResponse(200 , 'added to cart');
    }

    public function deletefromcart($request)
    {
       $cart = Cart::find($request->cart_id);
       if($cart)
       {
           $cart->delete();
           return $this->apiResponse(200,'Cart Was Deleted');
       }
       return  $this->apiResponse(400,'Cart not found');
    }

    public function updatecart($request)
    {
        $validations = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new UpdateCartValidation($request->product_id)]
        ]);
        if ($validations->fails()) {
            return $this->apiResponse(400, 'validation errors', $validations->errors());
        }

        $cart = Cart::where([ ['user_id' , Auth::user()->id], ['product_id' , $request->product_id] ])->first();

        if ($cart)
        {
            $cart->update([
                'count' => $request->count
            ]);
            return $this->apiResponse(200,'Cart Was Updated');
        }
        return  $this->apiResponse(400,'Cart not found');
    }

    public function usercart()
    {
        $carts = Cart::where('user_id' , Auth::user()->id)->get();
        return $this->apiResponse(200 , 'user cart' , null , $carts);
    }
}
