<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function profile(UserRequest $request)
    {
        return $this->authInterface->profile($request);
    }

    public function updateFoto(UserRequest $request)
    {
        return $this->authInterface->updateFoto($request);
    }

    public function refresh(UserRequest $request)
    {  
        return $this->authInterface->refresh($request);
    }

    public function logout(UserRequest $request)
    {
        return $this->authInterface->logout($request);
    }
}
