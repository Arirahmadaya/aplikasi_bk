<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Siswa;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $fillable = ['id','nama', 'nis', 'id_siswa','id_wali_kelas','tgl_pelanggaran','tingkat_pelanggaran', 'detail_pelanggaran'];
    protected $table = 'pelanggaran';
    public $timestamps  = false;

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }

    public function wali_kelas(): BelongsTo
    {
        return $this->belongsTo(WaliKelas::class, 'id_wali_kelas', 'id');
    }

}
