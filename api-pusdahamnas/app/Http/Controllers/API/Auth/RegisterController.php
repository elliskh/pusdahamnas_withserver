<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\OTPRequest;
use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoogleRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ApprovePegiatHAMRequest;
use App\Http\Requests\SendEmailPasswordRequest;
use App\Http\Requests\VerifRegistrationRequest;
use App\Http\Requests\SendEmailVerifikasiRequest;

class RegisterController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
        $this->middleware('auth:api', ['except' => ['register', 'verif', 'approve', 'sendemail', 'resendOtp']]);
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

    public function resendOtp(OTPRequest $request)
    {
        return $this->authInterface->resendOtp($request);
    }

    public function googleLogin(GoogleRequest $request)
    {
        return $this->authInterface->googleLogin();
    }
}
