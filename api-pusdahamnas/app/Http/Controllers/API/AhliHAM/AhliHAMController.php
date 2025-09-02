<?php

namespace App\Http\Controllers\API\AhliHAM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AhliHAMInterface;

class AhliHAMController extends Controller
{
    protected $ahliHamInterface;

    public function __construct(AhliHAMInterface $ahliHamInterface)
    {
        $this->ahliHamInterface = $ahliHamInterface;
    }

    public function index()
    {
        return $this->ahliHamInterface->all();
    }
}
