<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'tb_infografis';

    /**
     * Get all of the images for the Infografis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ImageInfografis::class);
    }
}
