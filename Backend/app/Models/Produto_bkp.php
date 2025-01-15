<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'data_validade',
        'imagem',
        'categoria_id',
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function setImagemAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes['imagem'] = $value->store('produtos', 'public');
        }
    }

    public function getImagemUrlAttribute()
    {
        return $this->imagem ? Storage::url($this->imagem) : null;
    }
}
