<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliHAM extends Model
{
    use HasFactory;

    protected $table = 'tb_ahli_ham'; 

    protected $guarded = [];

    public function topikahli() 
    {
        return $this->belongsTo(TopikHakDokumen::class, 'id_topik_hak', 'id_hak');
    }

    /**
     * Get the subyekdokumen that owns the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subyekahli()
    {
        return $this->belongsTo(SubyekDokumen::class, 'id_topik_subyek', 'id_subyek');
    }
}
