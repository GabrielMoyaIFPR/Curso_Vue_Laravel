<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function rules() {
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png'
        ];
    }

    public function feedbacks() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'imagem.mimes' => 'O arquivo da imagem deve ser do tipo .png',
            'nome.unique' => 'O nome da marca já foi cadastrado',
            'nome.min' => 'O nome da marca deve ter no mínimo 3 caracteres'
        ];
    }

    public function modelos() {
         return $this->hasMany('App\Models\Modelo');
    }
}
