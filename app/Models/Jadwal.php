<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'poli',
        'hari',
        'waktu',
        'maximal_reservasi',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'schedule_id');
    }
}
