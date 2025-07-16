<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $primaryKey = 'nomor';
    
    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'email',
        'nama',
        'umur',
        'kelamin',
        'nomor_hp',
        'alamat',
        'password',
    ];

    public $timestamps = false;
}
