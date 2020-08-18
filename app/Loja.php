<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = [
        "nome_da_loja", "email"
    ];

    protected $table = "loja";

    public $rules = [
        "nome_da_loja" => "required|max:40|min:3",
        "email" => "required|email:rfc,dns|unique:loja"
    ];

    public $rulesUpdate = [
        "nome_da_loja" => "max:40|min:3",
        "email" => "email:rfc,dns|unique:loja"
    ];

    public $message = [
        "nome_da_loja.required" => "Nome da Loja é obrigatório",
        "nome_da_loja.min" => "No mínimo 3",
        "nome_da_loja.max" => "No máximo 40",
        "email.required" => "Email é obrigatório",
        "email.email" => "Email não é válido",
        "email.unique" => "Email já cadastrado, tente com outro email diferente"
    ];
}
