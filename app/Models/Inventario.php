<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = ['minimo', 'existencia', 'producto_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
