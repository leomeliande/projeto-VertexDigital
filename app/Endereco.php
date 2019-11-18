<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf', 'unidade', 'ibge', 'gia'];
}
