<?php

namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AhliHAM;
use App\Models\UserWeb;
use App\Models\User_Role;
use App\Traits\ResponseAPI;
use App\Mail\PasswordRequest;
use App\Mail\VerifRegistration;
use App\Http\Requests\OTPRequest;
use App\Interfaces\AuthInterface;
use App\Mail\RegistrationSuccess;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GoogleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateFotoUserRequest;
use App\Http\Requests\ApprovePegiatHAMRequest;
use App\Http\Requests\SendEmailPasswordRequest;
use App\Http\Requests\VerifRegistrationRequest;
use App\Http\Requests\SendEmailVerifikasiRequest;

class AuthRepository implements AuthInterface
{
	use ResponseAPI;

	public function login(LoginRequest $request)
	{
		// DB::beginTransaction();

		// try {

		// 	$input = $request->all();

		// 	$fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		// 	$credentials = $request->only('username', 'password');

		// 	$token = Auth::attempt(array($fieldType => $input['email'], 'password' => $input['password']));

		// 	if (!$token) {
		// 		return $this->error("Unauthorized", 401);
		// 	}

		// 	$user = Auth::user();

		// 	$data = [
		// 		'user' => $user,
		// 		'authorisation' => [
		// 			'token' => $token,
		// 			'type' => 'bearer',
		// 		]
		// 	];

		// 	return $this->success("SUCCESS", $data);

		// } catch (\Exception $th) {
		// 	return $this->error($th, 400);
		// }

		try {
			$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL)
				? 'email'
				: 'username';

			$user = User::where($fieldType, $request->username)->first();

			if (!$user) {
				return $this->error("User not found", 404);
			}

			// selalu pakai HEX string, bukan binary
			$peppered = hash_hmac('sha256', $request->password, config('app.security.pepper'));

			// debug print
			// $tes = password_verify($peppered, $user->password);
			// return $user->password;
			// exit;

			if (!password_verify($peppered, $user->password)) {
				return $this->error("Invalid credentials", 401);
			}


			// Issue token manually since Auth::attempt won’t work with custom hashing
			$token = Auth::login($user);

			return $this->success("SUCCESS", [
				"user" => $user,
				"authorisation" => [
					"token" => $token,
					"type" => "bearer",
				]
			]);

		} catch (\Throwable $error) {
			Log::error('Login error: ' . $error->getMessage(), [
				'trace' => $error->getTraceAsString(),
				'payload' => $request->all()
			]);

			return response()->json([
				'status' => 'error',
				'message' => $error->getMessage()
			], 400);
		}

	}
	private function _generate_code()
	{
		return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
	}

	public function register(RegisterRequest $request)
	{
		DB::beginTransaction();

		try {

			// Ellis: this was for localhost
			// $baseUrl = env('EXTERNAL_API_BASE_URL', 'http://127.0.0.1:8080');

			// $pendidikan = $request->pendidikan ?? '';
			// $tipe_daftar = $request->tipe_daftar ?? 1;
			// $status_person = $request->status_person ?? 0;
			// $photo = $request->foto ?? null;

			// $response = Http::asForm()->withOptions(['verify' => false])
			// 	->post($baseUrl . '/auth/process_register_api', [
			// 		'username' => $request->username,
			// 		'email' => $request->email,
			// 		'name' => $request->name,
			// 		'password' => $request->password,
			// 		'lembaga_instansi' => $request->lembaga_instansi,
			// 		'pendidikan' => $pendidikan,
			// 		'tipe_daftar' => $tipe_daftar,
			// 		'status_person' => $status_person,
			// 		'photo' => $photo,
			// 	]);


			// $response = Http::asForm()->withOptions(['verify' => false])->post('https://dataham.komnasham.go.id/auth/process_register_api', [
			// 	'username' => $request->username,
			// 	'email' => $request->email,
			// 	'name' => $request->name,
			// 	'password' => $request->password,
			// 	'lembaga_instansi' => $request->lembaga_instansi,
			// 	'pendidikan' => $request->pendidikan,
			// 	'tipe_daftar' => $request->tipe_daftar,
			// 	'status_person' => $request->status_person,
			// 	'photo' => $request->foto,
			// ]);

			// $result = json_decode($response->body());

			// Log::info('Register payload:', $request->all());
			// return response()->json([
			// 	'status' => 'ok',
			// 	'data' => $result
			// ]);

			// Ellis: remove this
			// if ($result->code == 200) {

			if ($request->tipe_daftar == 2) {
				$role_id = 16;
				$is_active = 1;
			} elseif ($request->tipe_daftar == 1) {
				$role_id = 18;
				$is_active = 5; // Confirm this is intended
			} else {
				throw new \Exception('Invalid tipe_daftar');
			}

			try {
				// Ellis: changed
				// $numbers = '';
				// for ($i = 0; $i < 5; $i++) {
				// 	$numbers .= strval(random_int(1, 9)); // Menghasilkan angka acak antara 0 dan 9, lalu mengubahnya menjadi string
				// }

				$code = $this->_generate_code();
				$hashed_code = Hash::make($code);
				$expires = date('Y-m-d H:i:s', time() + 10 * 60); // 10 menit

				// Ellis: argon2i pass

				$peppered = hash_hmac('sha256', $request->password, config('app.security.pepper'));

				$hashed_password = password_hash($peppered, PASSWORD_ARGON2I);

				$users = User::create([
					'nama' => $request->name,
					'email' => $request->email,
					'username' => $request->username,
					'status_person' => $request->status_person,
					'password' => $hashed_password,
					'pendidikan' => $request->pendidikan ?: '',
					'reglembaga_reginstansi' => $request->lembaga_instansi ?: '',
					'photo' => $request->photo ?: '',
					'tipe_daftar' => $request->tipe_daftar,
					'verification_code' => $hashed_code,
					'verification_code_expires_at' => $expires,
					'is_verified' => $request->is_verified ? '1' : '0',
					'is_active' => 1,
					// 'name' => $request->name,
					// 'username' => $request->username,
					// 'email' => $request->email,
					// 'password' => Hash::make($request->password),
					// 'pendidikan' => $request->pendidikan,
					'id_lembaga' => 0,
					'status_approved' => 0,
					// 'verification_code' => Hash::make($numbers),
					// 'is_active' => 1,
					// 'is_approved' => $is_approved,
					// 'role_id' => $role_id,
				]);

				User_Role::create([
					'user_id' => $users->id,
					'role_id' => $role_id,
					'is_active' => $is_active,
				]);

				$user = User::find($users->id);

				// Ellis: async email sending, and combine with the next email

				// $title2 = 'Registrasi Akun Berhasil';
				// $body2 = 'Selamat registrasi akun anda berhasil, silahkan lakukan verifikasi akun anda terlebih dahulu agar akun anda dapat digunakan, terima kasih.';
				// try {
				// Mail::to($request->email)->send(new RegistrationSuccess($title2, $body2));
				// } catch (\Throwable $th) {
				// 	DB::rollBack();
				// 	return $this->error($th, 400);
				// }

				// $title = 'Selamat Bergabung Di Sistem Informasi Pusdahamnas';
				// $body = 'Verification Code Anda Adalah : ' . $numbers;

				// try {
				// 	Mail::to($request->email)->send(new VerifRegistration($title, $body));
				// } catch (\Throwable $th) {
				// 	DB::rollBack();

				// 	return $this->error($th->getTraceAsString(), 400);
				// }

				// $kpt = $this->sendVerificationCode($request->email, $request->name, $code);

				// echo $kpt;
				// exit;

				try {
					Mail::to($request->email)
						->queue(new RegistrationSuccess($request->name, $code));
				} catch (\Throwable $th) {
					DB::rollBack();
					return $this->error($th->getMessage(), 400);
				}

				DB::commit();

				$data = [
					'user' => $user,
					'verification_code' => $code
				];

				return $this->success("SUCCESS", $data);

			} catch (\Throwable $error) {
				DB::rollBack();
				// Log::info('Register payload:', $request->all());
				// return response()->json([
				// 	'status' => 'ok',
				// 	'data' => $error
				// ]);
				return $this->error($error->getTraceAsString(), 400);
			}

			// } else {
			// 	DB::rollBack();
			// 	return $this->error($result->message, 400);
			// }

			// dd($response->body());

			// $user = User::create([
			// 	'username' 	=> $request->username,
			// 	'name' 		=> $request->name,
			// 	'email' 	=> $request->email,
			// 	'password' 	=> Hash::make($request->password),
			// ]);

		} catch (\Exception $th) {
			return $this->error($th->getTraceAsString(), 400);
		}
	}

	public function logout(UserRequest $request)
	{
		Auth::logout();

		$data = [];

		return $this->success("SUCCESS", $data);

	}

	public function refresh(UserRequest $request)
	{
		$data = [
			'user' => Auth::user(),
			'authorisation' => [
				'token' => Auth::refresh(),
				'type' => 'bearer',
			]
		];

		return $this->success("SUCCESS", $data);
	}

	public function profile(UserRequest $request)
	{
		$data = [
			'user' => Auth::user(),
			'authorisation' => [
				'token' => Auth::refresh(),
				'type' => 'bearer',
			]
		];

		return $this->success("SUCCESS", $data);
	}

	public function updateFoto(UserRequest $request)
	{
		$file = $request->file('photo');
		$destinationPath = 'fotoahli/';

		// Pindahkan file ke external disk
		$path = $file->storeAs($destinationPath, $file->getClientOriginalName(), 'external');

		$userweb = UserWeb::where([
			'username' => $request->username,
			'email' => $request->email,
		])->get()->first();

		$user = User::where([
			'username' => $request->username,
			'email' => $request->email,
		])->get()->first();

		if ($userweb) {
			$userweb->update([
				'photo' => $file->getClientOriginalName()
			]);

			$user->update([
				'image_foto' => $file->getClientOriginalName()
			]);
		} else {
			return $this->error('Akun tidak ditemukan', 400);
		}

		return $this->success("SUCCESS", $path);
	}

	public function sendEmailPassword(SendEmailPasswordRequest $request)
	{
		$user = User::where([
			'username' => $request->username,
			'email' => $request->email
		])->get()->first();

		$userweb = UserWeb::where([
			'username' => $request->username,
			'email' => $request->email
		])->get()->first();

		if ($user) {
			$numbers = '';
			for ($i = 0; $i < 5; $i++) {
				$numbers .= strval(random_int(1, 9)); // Menghasilkan angka acak antara 0 dan 9, lalu mengubahnya menjadi string
			}

			//	$user->update([
			//	   'verification_code' => Hash::make($numbers),
			//	]);

			$title = 'Permintaan Password Baru';
			$body = 'Password Baru Anda Adalah : ' . $numbers;

			try {
				Mail::to($user->email)->send(new PasswordRequest($title, $body));
			} catch (\Throwable $th) {
				DB::rollBack();
				return $this->error($th, 400);
			}

			DB::commit();

			$data = [
				'user' => $user,
				'verification_code' => $numbers
			];

			return $this->success("SUCCESS", $data);

		} else {

			return $this->error('Akun tidak ditemukan', 400);

		}
	}

	public function sendEmail(SendEmailVerifikasiRequest $request)
	{
		$user = User::where([
			'username' => $request->username,
			'email' => $request->email
		])->get()->first();

		$userweb = UserWeb::where([
			'username' => $request->username,
			'email' => $request->email
		])->get()->first();

		if ($user) {
			$numbers = '';
			for ($i = 0; $i < 5; $i++) {
				$numbers .= strval(random_int(1, 9)); // Menghasilkan angka acak antara 0 dan 9, lalu mengubahnya menjadi string
			}

			$user->update([
				'verification_code' => Hash::make($numbers),
			]);

			$title = 'Selamat Bergabung Di Sistem Informasi Pusdahamnas';
			$body = 'Verification Code Anda Adalah : ' . $numbers;

			try {
				Mail::to($user->email)->send(new VerifRegistration($title, $body));
			} catch (\Throwable $th) {
				DB::rollBack();
				return $this->error($th, 400);
			}

			DB::commit();

			$data = [
				'user' => $user,
				'verification_code' => $numbers
			];

			return $this->success("SUCCESS", $data);

		} else {

			return $this->error('Akun tidak ditemukan', 400);

		}
	}

	public function verifRegister(VerifRegistrationRequest $request)
	{
		$user = User::where([
			'username' => $request->username,
			'email' => $request->email,
			// 'is_verified' => 0,
		])->get()->first();

		// Ellis: debugging
		// return response()->json([
		// 	'status' => 'ok',
		// 	'data' => $user
		// ]);

		// Ellis: remove this
		// $userweb = UserWeb::where([
		// 	'username' => $request->username,
		// 	'email' => $request->email,
		// 	'status_approved' => 0,
		// ])->get()->first();

		if ($user) {

			if (Hash::check($request->verification_code, $user->verification_code)) {

				// return response()->json([
				// 	'status' => 'ok',
				// 	'data' => $user->verification_code
				// ]);

				if ($user->role_id == 18) {

					// Ellis: changed
					// $user->update([
					// 	'is_verified' => 1,
					// 	'is_approved' => 1,
					// ]);

					// $userweb->update([
					// 	'is_active' => 1,
					// 	'is_verified' => '1',
					// 	'status_approved' => 1,
					// ]);

					$user->update([
						'is_active' => 1,
						'is_verified' => 1,
						'status_approved' => 1,
					]);

					$token = Auth::login($user);

					$data = [
						'user' => $user,
						'authorisation' => [
							'token' => Auth::refresh(),
							'type' => 'bearer',
						]
					];

					return $this->success("SUCCESS", $data);

				} else {

					// Ellis: changed
					// $user->update([
					// 	'is_verified' => 1,
					// 	'is_approved' => 0,
					// ]);

					// $userweb->update([
					// 	'is_active' => '1',
					// 	'is_verified' => '1',
					// 	'status_approved' => 0
					// ]);

					$user->update([
						'is_active' => '1',
						'is_verified' => '1',
						'status_approved' => 0
					]);

					$data = [
						'user' => $user,
					];

					return $this->success("SUCCESS", $data);

				}

			} else {

				return $this->error('Kode Verifikasi Salah', 402);
			}
		} else {
			return $this->error('Data Tidak Di Temukan', 401);
		}

	}

	public function approvePegiatHAM(ApprovePegiatHAMRequest $request)
	{
		try {
			$user = User::where([
				'username' => $request->username,
				'email' => $request->email
			])->get()->first();

			$userweb = UserWeb::where([
				'username' => $request->username,
				'email' => $request->email
			])->get()->first();

			if ($user->role_id == 18) {

				$user->update([
					'is_verified' => 1,
					'is_approved' => 1,
				]);

				$token = Auth::login($user);

				$data = [
					'user' => $user,
					'userweb' => $userweb,
					'authorisation' => [
						'token' => Auth::refresh(),
						'type' => 'bearer',
					]
				];

				return $this->success("SUCCESS", $data);

			} else {

				if ($user->is_approved == 1) {
					$status = 0;
				} else {
					$status = 1;
				}

				$user->update([
					'is_verified' => $status,
					'is_approved' => $status,
				]);

				$cekahliham = AhliHAM::where('email', $user->email)->get()->first();

				if ($cekahliham) {
					$cekahliham->update([
						'nama' => $userweb->nama,
						'status_person' => $userweb->status_person,
						'instansi' => $user->lembaga,
						'email' => $user->email,
						'foto' => $userweb->lembaga,
					]);
				} else {
					$ahliham = AhliHAM::create([
						'nama' => $userweb->nama,
						'status_person' => $userweb->status_person,
						'instansi' => $user->lembaga,
						'email' => $user->email,
						'foto' => $userweb->lembaga,
					]);
				}

				$data = [
					'user' => $user,
					'userweb' => $userweb,
				];

				return $this->success("SUCCESS", $data);
			}
		} catch (\Throwable $th) {
			return $this->error($th, 400);
		}
	}

	public function updateProfile(UserRequest $request)
	{
		$user_id = Auth::user()->id;

		$user = User::update($request->all());

		return $this->success("Profile Updated Successfully", $user);
	}

	public function updateFotoProfile(UpdateFotoUserRequest $request)
	{
		$user_id = Auth::user()->id;
	}

	// Ellis: kode verifikasi
	public function sendVerificationCode(string $email, string $code, string $name = '')
	{
		try {
			Mail::to($email)
				->send(new RegistrationSuccess($name, $code));
			return true;
		} catch (\Throwable $th) {
			DB::rollBack();
			return $this->error($th->getMessage(), 400);
		}
	}

	public function resendOtp(OTPRequest $request)
	{
		Log::info('Register payload:', $request->all());

		// Validasi input
		$request->validate([
			'email' => 'required|email',
			// 'name' => 'required|string',
		]);

		$email = $request->input('email');
		$name = $request->input('name')?:'';
		// return response()->json([
		// 	'success' => true,
		// 	'message' => 'resendOTeP'
		// ]);

		// Generate kode OTP
		$code = $this->_generate_code(); // buat fungsi private untuk generate OTP
		$expires = date('Y-m-d H:i:s', time() + 10 * 60); // 10 menit

		// Update database
		$updated = DB::table('users')
			->where('email', $email)
			->update([
				'verification_code' => $code,
				'verification_code_expires_at' => $expires,
				'updated_at' => Carbon::now(), // jika ada timestamps
			]);

		if ($updated) {
			// Kirim email OTP
			try {
				$this->sendVerificationCode($email, $code, $name);

				return response()->json([
					'status' => true,
					'message' => 'Kode OTP baru sudah dikirim ke email',
					'verification_code' => $code,
				]);

			} catch (\Exception $e) {
				return response()->json([
					'status' => false,
					'message' => 'Gagal mengirim email OTP',
				], 500);
			}
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Gagal memperbarui kode OTP',
			], 400);
		}
	}

	public function googleLogin(GoogleRequest $request)
	{
		Log::info('Register payload:', $request->all());
		return response()->json([
			'status' => 'ok',
			'data' => 'googleLogin'
		]);
	}
}
