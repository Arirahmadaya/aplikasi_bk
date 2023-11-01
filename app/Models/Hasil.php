<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Konseling;


class Hasil extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_konseling','catatan'];
    protected $table = 'hasil';
    public $timestamps  = false;


    public function konseling(): BelongsTo
    {
        return $this->belongsTo(Konseling::class, 'id_konseling', 'id');
    }

    

}
