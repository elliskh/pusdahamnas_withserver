<?php

namespace App\Http\Controllers\API\LembagaHAM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\LembagaHAMInterface;
use App\Http\Requests\LembagaHAMRequest;

class LembagaHAMController extends Controller
{
    protected $lembagaHamInterface;

    public function __construct(LembagaHAMInterface $lembagaHamInterface)
    {
        $this->lembagaHamInterface = $lembagaHamInterface;
    }

    public function index()
    {
        return $this->lembagaHamInterface->all();
    }

    public function getByCountPage(LembagaHAMRequest $request)
    {
        return $this->lembagaHamInterface->getByCountPage($request);
    }
} 
