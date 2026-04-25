<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class ResponsiblePeople extends Model
{
    protected $table = 'responsible_people';
    protected $fillable = [
        'karismatif_profile_id',
        'bidang_id',
        'nama_pengurus',
        'nama_panggilan',
        'photo_profile_path',
    ];

    public function profile()
    {
        return $this->belongsTo(KarismatifProfile::class, 'karismatif_profile_id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    //* relasi program kerja -> profile
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class);
    }
}
