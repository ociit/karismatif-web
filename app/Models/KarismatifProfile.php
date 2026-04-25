<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KarismatifProfile extends Model
{
    protected $fillable = ['nama_kabinet', 'visi', 'logo_path', 'periode',];

    //* relasi mission -> profile
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    //* relasi contact person -> profile
    public function contactPerson()
    {
        return $this->hasMany(ContactPerson::class);
    }

    //* relasi responsible people -> profile
    public function responsiblePeople()
    {
        return $this->hasMany(ResponsiblePeople::class);
    }

    //* relasi program kerja -> profile
    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class);
    }
}
