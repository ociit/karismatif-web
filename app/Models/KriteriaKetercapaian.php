<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaKetercapaian extends Model
{
    protected $fillable = [
        'program_kerja_id',
        'kriteria',
        'bobot_ketercapaian',
        'isTercapai'
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id');
    }
}
