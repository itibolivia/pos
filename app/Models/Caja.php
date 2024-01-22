<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['estado', 'monto', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
