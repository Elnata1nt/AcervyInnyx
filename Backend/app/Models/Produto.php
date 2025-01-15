<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'descricao', 'preco', 'data_validade', 'categoria_id', 'imagem'
    ];

    public function getImagemUrlAttribute()
    {
        return asset('storage/images/' . $this->imagem);
    }

    public function setImagemAttribute($value)
    {
        $this->attributes['imagem'] = 'images/' . $value;
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
