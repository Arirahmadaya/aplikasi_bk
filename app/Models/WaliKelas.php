<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class WaliKelas extends Model
{
    use HasFactory;
    protected $fillable = ['id','nama', 'id_user'];
    protected $table = 'wali_kelas';
    public $timestamps  = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
