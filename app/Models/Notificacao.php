<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = [
        'titulo',
        'mensagem', 
        'tipo',
        'lida',
        'data_notificacao'
    ];

    protected $casts = [
        'data_notificacao' => 'datetime',
        'lida' => 'boolean'
    ];

    public function scopeNaoLidas($query)
    {
        return $query->where('lida', false);
    }

    public function scopeRecentes($query)
    {
        return $query->orderBy('data_notificacao', 'desc');
    }
}
