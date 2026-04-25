<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProkerDocumentation extends Model
{
    protected $fillable = [
        'program_kerja_id',
        'photo_documentation_path',
        'keterangan',
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id');
    }
}
