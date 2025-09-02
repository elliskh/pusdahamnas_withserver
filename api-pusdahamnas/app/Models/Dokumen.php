<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'tb_dokumen';

    /**
     * Get the jenisdokumen that owns the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisdokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'id_jenis_dokumen', 'id_jenis');
    }

    /**
     * Get the topikdokumen that owns the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topikdokumen()
    {
        return $this->belongsTo(TopikHakDokumen::class, 'id_topik_hak', 'id_hak');
    }

    /**
     * Get the subyekdokumen that owns the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subyekdokumen()
    {
        return $this->belongsTo(SubyekDokumen::class, 'id_topik_subyek', 'id_subyek');
    }

    /**
     * Get the lembagadokumen that owns the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lembagadokumen()
    {
        return $this->belongsTo(LembagaDokumen::class, 'id_lembaga', 'id');
    }

    /**
     * Get all of the pengunduh for the Dokumen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengunduh()
    {
        return $this->hasMany(PengunduhDokumen::class, 'id_dokumen', 'id');
    }
}
