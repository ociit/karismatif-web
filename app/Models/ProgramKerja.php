<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ReturnTypeWillChange;

class ProgramKerja extends Model
{
    protected $fillable = [
        'karismatif_profile_id',
        'bidang_id',
        'responsible_people_id',
        'mission_id',
        'nama_proker',
        'deskripsi',
        'photo_proker_path',
    ];

    public function profile()
    {
        return $this->belongsTo(KarismatifProfile::class, 'karismatif_profile_id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function responsiblePeople()
    {
        return $this->belongsTo(ResponsiblePeople::class, 'responsible_people_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    //* relasi kriteria ketercapaian -> program kerja
    public function kriteriaKetercapaian()
    {
        return $this->hasMany(KriteriaKetercapaian::class);
    }

    //* relasi proker documentation -> program kerja
    public function prokerDocumentation()
    {
        return $this->hasMany(ProkerDocumentation::class);
    }
}
