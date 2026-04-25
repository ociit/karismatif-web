<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'karismatif_profile_id',
        'nama',
        'nomor_telp',
        'keterangan',
    ];

    public function profile()
    {
        return $this->belongsTo(KarismatifProfile::class, 'karismatif_profile_id'); 
    }
}
