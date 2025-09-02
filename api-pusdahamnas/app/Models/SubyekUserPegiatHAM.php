<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubyekUserPegiatHAM extends Model
{
    use HasFactory;

    protected $table = 'subyek_user_pegiat_ham';

    protected $fillable = [
        'user_id',
        'subyek_id',
    ];
}
