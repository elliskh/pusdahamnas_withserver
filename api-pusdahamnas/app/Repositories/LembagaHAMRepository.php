<?php

namespace App\Repositories;

use App\Interfaces\LembagaHAMInterface;
use App\Models\Lembaga;
use App\Traits\ResponseAPI;
use App\Http\Requests\LembagaHAMRequest;

class LembagaHAMRepository implements LembagaHAMInterface
{
	use ResponseAPI;    

	public function all()
	{
		$lembaga = Lembaga::where('is_active', 1)->orderBy('created_at', 'DESC')->get();

		$data = [
			'total_data' => count($lembaga),
			'lembaga' => $lembaga	
		];

		return $this->success("SUCCESS", $data); 
	}

	public function getByCountPage(LembagaHAMRequest $request)
	{
		$lembaga = Lembaga::where('is_active', 1)->orderBy('created_at', 'DESC')->take($request->total_data)->get();

		$data = [
			'total_data' => count($lembaga),
			'lembaga' => $lembaga	
		];

		return $this->success("SUCCESS", $data); 
	}
}