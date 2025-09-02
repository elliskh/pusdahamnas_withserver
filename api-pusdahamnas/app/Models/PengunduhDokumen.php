<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengunduhDokumen extends Model
{

    use HasFactory;

    protected $table = 'tb_dokumen_pengunduh'; 

    // public $timestamps = false;

    protected $guarded = [];

    const UPDATED_AT = null;

}
