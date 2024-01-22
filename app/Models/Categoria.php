<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['nombre', 'activo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
