<?php

namespace App\Interfaces;

use App\Http\Requests\GlosariumRequest;

interface GlosariumInterface
{
	public function all();

	public function getByCountPage(GlosariumRequest $request);
}