<?php

namespace App\Repositories;

use App\Interfaces\InfografisInterface;
use App\Models\Infografis;
use App\Traits\ResponseAPI;


class InfografisRepository implements InfografisInterface
{
	use ResponseAPI;    

	public function all()
	{
		$infografis = Infografis::where('is_active', '1')->orderBy('id', 'DESC')->with(['images'])->get();

		$data = [
			'infografis' => $infografis	
		];

		return $this->success("SUCCESS", $data); 
	}
}