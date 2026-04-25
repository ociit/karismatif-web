<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Inline\HtmlInline;

class Bidang extends Model
{
    protected $fillable = [
        'nama_bidang', 
        'deskripsi'
    ];

    //* relasi responsible people -> bidang
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
