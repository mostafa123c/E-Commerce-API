<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\orderInterface;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public $orderinterface;
   public function __construct(orderInterface $orderinterface)
   {
       $this->orderinterface = $orderinterface;
   }

   public function checkout()
   {
       return $this->orderinterface->checkout();
   }
}
