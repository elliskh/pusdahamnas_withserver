<?php

namespace App\Http\Controllers\API\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\DokumenInterface;
use App\Http\Requests\DokumenRequest;
use App\Http\Requests\DownloadDokumenRequest;

class DokumenController extends Controller
{
    protected $dokumenInterface;

    public function __construct(DokumenInterface $dokumenInterface)
    {
        $this->dokumenInterface = $dokumenInterface;
    }

    public function index()
    {
        return $this->dokumenInterface->index();
    }

    public function getByCountPage(DokumenRequest $request)
    {
        return $this->dokumenInterface->getByCountPage($request);
    }

    public function downloadDokumen(DownloadDokumenRequest $request)
    {
        return $this->dokumenInterface->downloadDokumen($request);
    }
}
