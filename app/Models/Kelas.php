<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\WaliKelas;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['kelas', 'jumlah_siswa', 'id_wali_kelas'];
    protected $table = 'kelas';
    public $timestamps  = false;

    public function wali_kelas(): BelongsTo
    {
        return $this->belongsTo(WaliKelas::class, 'id_wali_kelas', 'id');
    }
}
