<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'email',
        'nama',
        'umur',
        'kelamin',
        'nomor_hp',
        'alamat',
        'schedule_id',
        'keluhan',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'schedule_id');
    }
}
