<?php

namespace App\Repositories;

use App\Http\Requests\ApiKeyRequest;
use App\Http\Requests\ApproveApiKeyRequest;
use App\Interfaces\ApiKeyInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Str;
use App\Models\ApiKey;
use App\Models\UserWeb;
use DB;

class ApiKeyRepository implements ApiKeyInterface 
{
	use ResponseAPI;    

	public function requestApiKey(ApiKeyRequest $request, $id = null)
	{
		DB::beginTransaction();

		try {

            $apikey = $id ? ApiKey::find($id) : new ApiKey;

            if($id && !$apikey) return $this->error("No apikey with ID $id", 404);

            $apikey->name = $request->name;

            $apikey->email = preg_replace('/\s+/', '', strtolower($request->email));

            $apikey->save();

            DB::commit();
            return $this->success(
                $id ? "Api Key Updated"
                    : "Permintaan Api Key Berhasil",
                $apikey, $id ? 200 : 201);
			
		} catch (\Exception $th) {

			DB::rollBack();

			return $this->error($e->getMessage(), $e->getCode());
		}
	} 

    public function approveApiKey(ApproveApiKeyRequest $request) 
    {
        $cekuserweb = UserWeb::where([
            'username' => $request->username,
            'email' => $request->email,
        ])->get();

        if (count($cekuserweb) > 0) {

            DB::beginTransaction();

            try {

                $apikey = ApiKey::where([
                    'id' => $request->apikey_id,
                    'is_active' => 0,
                    'is_approved' => 0
                ])->get()->first();

                if(!$apikey) return $this->error("No api key with ID $request->apikey_id", 404);

                $randomstring = Str::random(35);

                $apikey->update([
                    'is_active'   => 1,
                    'is_approved' => 1,
                    'api_key'  => bcrypt($randomstring),
                ]);

                DB::commit();

                return $this->success("Api Key successfully approved", $apikey);

            } catch(\Exception $e) {

                DB::rollBack();
                
                return $this->error($e->getMessage(), $e->getCode());
            }

        } else {
            return $this->error('Unknown Authorization', 401);
        }
        
    }

	public function deleteApiKey($id)
    {
        DB::beginTransaction();
        try {

            $apikey = ApiKey::find($id);

            if(!$apikey) return $this->error("No api key with ID $id", 404);

            $apikey->delete();

            DB::commit();

            return $this->success("Api Key deleted", $apikey);

        } catch(\Exception $e) {

            DB::rollBack();
			
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}