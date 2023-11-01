<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kelas;
use App\Models\User;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nis','nama', 'tmp_lahir','tgl_lahir', 'jk', 'nohp', 'nohp_ortu' , 'alamat', 'id_kelas', 'id_user'];
    protected $table = 'siswa';
    public $timestamps  = false;

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
