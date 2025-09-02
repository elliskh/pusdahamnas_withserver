<?php

namespace App\Interfaces;

use App\Http\Requests\GoogleRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OTPRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifRegistrationRequest;
use App\Http\Requests\ApprovePegiatHAMRequest;
use App\Http\Requests\SendEmailVerifikasiRequest;
use App\Http\Requests\UserRequest;

interface AuthInterface 
{
	public function login(LoginRequest $request);

	public function register(RegisterRequest $request);

	public function logout(UserRequest $request);

	public function refresh(UserRequest $request); 

	public function profile(UserRequest $request); 

	public function updateFoto(UserRequest $request); 

	public function verifRegister(VerifRegistrationRequest $request);

	public function sendEmail(SendEmailVerifikasiRequest $request);

	public function approvePegiatHAM(ApprovePegiatHAMRequest $request);

	public function resendOtp(OTPRequest $request);

	public function googleLogin(GoogleRequest $request);
}