<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthInterface; 

class LoginController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function login(LoginRequest $request) 
    {
        return $this->authInterface->login($request);
    }
}
