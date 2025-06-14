<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    public function guru(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
