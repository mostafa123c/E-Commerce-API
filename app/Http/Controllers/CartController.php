<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\CartInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $cartinterface;
    public function __construct(CartInterface $cartinterface)
    {
        $this->cartinterface = $cartinterface;
    }

    public function addtocart(Request $request)
    {
        return $this->cartinterface->addtocart($request);
    }

    public function usercart()
    {
        return $this->cartinterface->usercart();
    }

    public function deletefromcart(Request $request)
    {
        return $this->cartinterface->deletefromcart($request);
    }

    public function updatecart(Request $request)
    {
        return $this->cartinterface->updatecart($request);
    }




}
