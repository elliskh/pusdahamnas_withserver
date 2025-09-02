<?php

namespace App\Interfaces;

use App\Http\Requests\ApiKeyRequest;
use App\Http\Requests\ApproveApiKeyRequest;

interface ApiKeyInterface 
{
	
	public function requestApiKey(ApiKeyRequest $request, $id = null);

	public function approveApiKey(ApproveApiKeyRequest $request); 

	public function deleteApiKey($id);

}