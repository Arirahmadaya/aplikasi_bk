<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Konseling;

class Riwayat extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','id_konseling'];
    protected $table = 'riwayat';
    public $timestamps  = false;
    

    public function konseling(): BelongsTo
    {
        return $this->belongsTo(Konseling::class, 'id_konseling', 'id');
    }

}
