<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\VerifRegistrationRequest;
use App\Http\Requests\ApprovePegiatHAMRequest;
use App\Http\Requests\SendEmailVerifikasiRequest;
use App\Http\Requests\SendEmailPasswordRequest;
use App\Interfaces\AuthInterface;

class SetPasswordController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
        $this->middleware('auth:api', ['except' => ['sendemailpassword']]);
    }
 
    public function sendemailpassword(SendEmailPasswordRequest $request)
    {
        return $this->authInterface->sendEmailPassword($request);
    } 

}
