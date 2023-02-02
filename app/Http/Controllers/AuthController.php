<?php

namespace App\Http\Controllers;


use App\Http\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $authinterface;

    public function __construct(AuthInterface $authinterface)
    {
        $this->authinterface = $authinterface;
    }

    public function register(Request $request)
    {
        return $this->authinterface->register($request);
    }

    public function login(Request $request)
    {
        return $this->authinterface->login($request);
    }
}
