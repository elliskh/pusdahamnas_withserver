<?php

namespace App\Repositories;

use App\Interfaces\GlosariumInterface;
use App\Models\Glosarium;
use App\Traits\ResponseAPI;
use App\Http\Requests\GlosariumRequest;

class GlosariumRepository implements GlosariumInterface
{
	use ResponseAPI;    

	public function all()
	{
		$glosarium = Glosarium::where('deleted_at', null)->get();
		
		$data = [
			'total_data' => count($glosarium),
			'glosarium' => $glosarium	
		];

		return $this->success("SUCCESS", $data); 
	}

	public function getByCountPage(GlosariumRequest $request)
	{
		$glosarium = Glosarium::where('deleted_at', null)->take($request->total_data)->get();

		$data = [
			'total_data' => count($glosarium),
			'glosarium' => $glosarium	
		];

		return $this->success("SUCCESS", $data); 
	}
}