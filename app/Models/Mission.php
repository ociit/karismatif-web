<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'karismatif_profile_id',
        'urutan',
        'nama_misi',
        'keterangan_misi'
    ];

    public function profile()
    {
        return $this->belongsTo(KarismatifProfile::class, 'karismatif_profile_id');
    }

    //* relasi program kerja -> profile
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class);
    }
}
