<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    protected $fillable = ['nama', 'poli', 'hari', 'waktu', 'maximal_reservasi'];
}
