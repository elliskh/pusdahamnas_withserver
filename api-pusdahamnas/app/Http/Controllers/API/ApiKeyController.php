<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ApiKeyRequest;
use App\Interfaces\ApiKeyInterface;
use App\Http\Requests\ApproveApiKeyRequest;
use App\Models\ApiKey;

class ApiKeyController extends Controller
{
    
    protected $apikeyInterface;

    public function __construct(ApiKeyInterface $apikeyInterface)
    {
        $this->apikeyInterface = $apikeyInterface;
    }

    public function index()
    {
        return 'tes';
    }

    public function store(ApiKeyRequest $request)
    {
        return $this->apikeyInterface->requestApiKey($request);
    }

    public function approve(ApproveApiKeyRequest $request)
    {
        return $this->apikeyInterface->approveApiKey($request);
    }

    public function destroy($id)
    {
        return $this->apikeyInterface->deleteApiKey($id);
    }
}  
