<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['fecha', 'pago', 'cambio', 'tipo', 'cliente_id', 'caja_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}


