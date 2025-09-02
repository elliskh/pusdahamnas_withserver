<?php

namespace App\Repositories;

use App\Interfaces\DokumenInterface;
use App\Models\Dokumen;
use App\Models\PengunduhDokumen;
use App\Models\UserWeb;
use App\Models\User;
use App\Traits\ResponseAPI;
use App\Http\Requests\DokumenRequest;
use App\Http\Requests\DownloadDokumenRequest;


class DokumenRepository implements DokumenInterface
{
	use ResponseAPI;    

	public function index()
	{
		$dokumen = Dokumen::where('deleted_at', null)->orderBy('created_at', 'DESC')
							->take(150)
							->with(['jenisdokumen','topikdokumen','subyekdokumen','lembagadokumen'])
							->withCount('pengunduh')
							->get();

		$data = [
			'total_data' => count($dokumen),
			'dokumens' => $dokumen
		];

		return $this->success("SUCCESS", $data);
	}

	public function getByCountPage(DokumenRequest $request)
	{
		$dokumen = Dokumen::where('deleted_at', null)->orderBy('created_at', 'DESC')
			->with(['jenisdokumen','topikdokumen','subyekdokumen','lembagadokumen'])
			->withCount('pengunduh')
			->take($request->total_data)->get();

		$data = [
			'total_data' => count($dokumen),
			'dokumens' => $dokumen	
		];

		return $this->success("SUCCESS", $data); 
	}

	public function downloadDokumen(DownloadDokumenRequest $request)
	{
		$user = User::where([
			'username' => $request->username,
			'email'	   => $request->email
		])->get()->first();

		if ($user) {
			$pengunduh = PengunduhDokumen::create([
				'id_dokumen' => $request->id_dokumen,
				'nama'		 => $user->name,
				'email'	     => $user->email,
				'instansi'	 => $user->lembaga,
				'tujuan'	 => $request->tujuan,
			]);

			$data = [
				'pengunduh_dokumen' => $pengunduh	
			];
	
			return $this->success("SUCCESS", $data); 
		}

		return $this->error('Akun tidak ditemukan', 400);
	}


}