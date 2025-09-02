<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakUserPegiatHAM extends Model
{
    use HasFactory;

    protected $table = 'hak_user_pegiat_ham';

    protected $fillable = [
        'user_id',
        'hak_id',
    ];
}
