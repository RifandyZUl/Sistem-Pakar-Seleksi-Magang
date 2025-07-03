<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'bobot', 'sifat'];

    public function nilai()
    {
        return $this->hasMany(NilaiAlternatif::class);
    }
}
