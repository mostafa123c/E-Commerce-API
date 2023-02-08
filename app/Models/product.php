<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable =['name' ,'price' ,'stock' ];

    public static function rules()
    {
        return [
            'name'=>'required|min:2',
            'price'=>'required',
            'stock'=>'required'
        ];
    }


}
