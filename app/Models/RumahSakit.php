<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RumahSakit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rumah_sakit';

    protected $fillable = ['nama', 'alamat', 'email', 'telepon'];


    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'rumah_sakit_id');
    }

    public function getJumlahPasien()
    {
        return $this->pasien()->count();
    }
}
