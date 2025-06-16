<?php

namespace App\Models;

use App\Livewire\OrangTua as LivewireOrangTua;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class orangtua extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'siswa_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
