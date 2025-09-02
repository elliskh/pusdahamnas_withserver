<?php

namespace App\Interfaces;

use App\Http\Requests\DokumenRequest;
use App\Http\Requests\DownloadDokumenRequest;

interface DokumenInterface
{
	public function index();

	public function getByCountPage(DokumenRequest $request); 

	public function downloadDokumen(DownloadDokumenRequest $request);
}