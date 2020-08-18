<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected  $fillable = [
        "nome", "valor", "loja_id", "ativo"
    ];

    protected $table = "produto";

    public $rules = [
        "nome" => "required|max:60|min:3",
        "valor" => "required|min:2","max:6",
        "loja_id" => "required|integer",
        "ativo" => "boolean"
    ];

    public $message = [
        "nome.required" => "Campo nome é obrigatório",
        "nome.max" => "No máximo 60 caracteres",
        "nome.min" => "No mínimo 3 caracteres",
        "valor.required" => "Campo valor é obrigatório",
        "valor.integer" => "Valor tem que ser inteiro",
        "valor.max" => "No máximo 6 caracteres",
        "valor.min" => "No mínimo 2 caracteres",
        "loja_id.required" => "Campo loja_id é obrigatório",
        "ativo.boolean" => "Campo ativo valor boleano"
    ];
}
