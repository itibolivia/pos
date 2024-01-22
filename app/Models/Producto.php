<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'activo', 'imagen', 'categoria_id', 'user_id'];

    protected $appends = ['ruta'];

    public function getRutaAttribute(): string
    {
        return url('images/'.$this->imagen);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
