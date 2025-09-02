<?php

namespace App\Interfaces;

use App\Http\Requests\LembagaHAMRequest;

interface LembagaHAMInterface
{

	public function all();
	
	public function getByCountPage(LembagaHAMRequest $request);
}