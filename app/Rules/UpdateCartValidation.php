<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateCartValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $product_id;
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
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
        $product = Product::where( [['id' , '=' ,$this->product_id] , ['stock' , '>=' , $value ] ])->first();
        if ($product){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'product is out of stock';
    }
}
