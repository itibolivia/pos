<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DetalleNota extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['cantidad', 'precio', 'producto_id', 'nota_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }
}
