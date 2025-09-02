<?php

namespace App\Repositories;

use App\Interfaces\AhliHAMInterface;
use App\Models\AhliHAM;
use App\Traits\ResponseAPI;
use App\Http\Requests\AhliHAMRequest;

class AhliHAMRepository implements AhliHAMInterface
{
	use ResponseAPI;    

	public function all()
	{
		$ahliham = AhliHAM::where('is_active', 1)->orderBy('created_at', 'DESC')
		->with(['topikahli','subyekahli'])->get();

		$data = [
			'total_data' => count($ahliham),
			'ahliham' => $ahliham	
		];

		return $this->success("SUCCESS", $data); 
	}
}