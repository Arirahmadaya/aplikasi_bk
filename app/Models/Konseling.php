<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pelanggaran;
use App\Models\User;
use App\Models\Siswa;


class Konseling extends Model
{
    use HasFactory;
    protected $fillable = ['jadwal_konseling','id_pelanggaran', 'id_user', 'status'];
    protected $table = 'konseling';
    public $timestamps  = false;

    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'id_siswa', 'id');
    }

}
