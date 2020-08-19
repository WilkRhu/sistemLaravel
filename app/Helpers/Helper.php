<?php


namespace App\Helpers;


use App\Mail\SendMailUser;
use App\Produtos;
use Illuminate\Support\Facades\Mail;

class Helper
{
    public static function enviMail($email, $tipo) {
            //Mail::to($email)->send(new SendMailUser("mail.cadProduto")); Email chama a view que passa a mensagen quando o produto é cadastrado
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
            "ativo" => $produto->ativo,
            "created_at" => $produto->created_at,
            "updated_at" => $produto->updated_at
        ];

        return $newProduto;
    }

    public static function valorProdutos($produtos) {
        $newArray = [];
        foreach ($produtos as $produto) {
            $valor = $produto->valor;
            if(strlen($valor) > 3 ){
                $produto->valor = "R$: ".number_format($valor, 2, ",", ".");
            } else {
                $produto->valor = "R$: ".number_format($valor, 2, ",", "");
            }
            array_push($newArray, $produto);

        }
    }
}
