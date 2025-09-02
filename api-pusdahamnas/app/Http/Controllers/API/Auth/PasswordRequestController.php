<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifRegistrationRequest;
use App\Http\Requests\ApprovePegiatHAMRequest;
use App\Http\Requests\SendEmailVerifikasiRequest;
use App\Http\Requests\SendEmailPasswordRequest;
use App\Interfaces\AuthInterface;

class PasswordRequestController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
        $this->middleware('auth:api', ['except' => ['register', 'verif', 'approve', 'sendemail', 'sendemailpassword']]);
    }

    public function register(RegisterRequest $request)
    {
        return $this->authInterface->register($request);
    }

    public function verif(VerifRegistrationRequest $request)
    {
        return $this->authInterface->verifRegister($request);
    }

    public function sendemail(SendEmailVerifikasiRequest $request)
    {
        return $this->authInterface->sendEmail($request);
    }
    
    public function sendemailpassword(SendEmailPasswordRequest $request)
    {
        return $this->authInterface->sendEmailPassword($request);
    }

    public function approve(ApprovePegiatHAMRequest $request)
    {
        return $this->authInterface->approvePegiatHAM($request);
    }
}
