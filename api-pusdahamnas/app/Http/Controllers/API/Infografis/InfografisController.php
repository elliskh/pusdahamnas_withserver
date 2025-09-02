<?php

namespace App\Http\Controllers\API\Infografis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\InfografisInterface;

class InfografisController extends Controller
{
    protected $infografisInterface;

    public function __construct(InfografisInterface $infografisInterface)
    {
        $this->infografisInterface = $infografisInterface;
    }

    public function index()
    {
        return $this->infografisInterface->all();
    }
}
