<?php


namespace App\Helpers;


use App\Mail\SendMailUser;
use App\Produtos;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Mail;

class Helper
{
    public static function enviMail($email, $tipo) {
            Mail::to($email)->send(new SendMailUser());
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
