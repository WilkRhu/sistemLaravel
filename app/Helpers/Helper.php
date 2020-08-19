<?php


namespace App\Helpers;


use App\Produtos;
use Illuminate\Support\Facades\Mail;

class Helper
{
    public static function enviMail($email, $tipo) {
        Mail::raw("Produto Atualizado", function($message) use($email) {
            $message->from("wilk.caetano@gmail.com");
            $message->subject('Cadastro do Produto Realizado');
            $message->to($email);
        });
    }

    public static function valor($produto) {
         $valor = $produto->valor;
        if(strlen($valor) > 3 ){
            $novoValor = "R$: ".number_format($valor, 2, ",", ".");
        } else {
            $novoValor = "R$: ".number_format($valor, 2, ",", "");
        }
        $newProduto = [
            "id" => $produto->id,
            "nome" => $produto->nome,
            "valor" => $novoValor,
            "loja_id" => $produto->loja_id,
            "ativo" => $produto->ativo
        ];

        return $newProduto;
    }

    public static function valorLojas($produtos) {
        $newArray = [];
        foreach ($produtos as $produto) {
            $valor = $produto->valor;
            if(strlen($valor) > 3 ){
                $novoValor = "R$: ".number_format($valor, 2, ",", ".");
            } else {
                $novoValor = "R$: ".number_format($valor, 2, ",", "");
            }
            array_push($newArray, [
                "id" => $produto->id,
                "nome" => $produto->nome,
                "valor" => $novoValor,
                "loja_id" => $produto->loja_id,
                "ativo" => $produto->ativo
            ]);
        }
        return $newArray;

    }
}
