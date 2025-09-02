<?php

namespace App\Http\Controllers\API\Glosarium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\GlosariumInterface;
use App\Http\Requests\GlosariumRequest;

class GlosariumController extends Controller
{
    protected $glosariumInterface;

    public function __construct(GlosariumInterface $glosariumInterface)
    {
        $this->glosariumInterface = $glosariumInterface;
    }

    public function index()
    {
        return $this->glosariumInterface->all();
    }

    public function getByCountPage(GlosariumRequest $request)
    {
        return $this->glosariumInterface->getByCountPage($request);
    }
}
 