<?php

namespace App\Http\Interfaces;

interface CartInterface
{
    public function addtocart($request);

    public function deletefromcart($request);

    public function updatecart($request);

    public function usercart();
}
