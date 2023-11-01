<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Operator extends Model
{
    use HasFactory;
    protected $fillable = ['id','nama', 'email', 'id_user'];
    protected $table = 'operator';
    public $timestamps  = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
