<?php

namespace App\Http\Controllers;

use App\Loja;
use App\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class produtosController extends Controller
{

    private $produto;

    public function __construct(Produtos $produto)
    {
        header('Acess-Control-Allow-Origin: *');
        $this->produto = $produto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("Retorno!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->produto->rules, $this->produto->message);
        if ($validate->fails()) {
            return response()
                ->json($validate->errors(), 400);
        } else {
            $produto = $this->produto;
            $produto->nome = $request->post("nome");
            $produto->valor = intval($request->post("valor"));
            $produto->loja_id = $request->post("loja_id");
            $produto->ativo = $request->post("ativo");
            $produto->save();
            $loja = Loja::find($produto->loja_id);
            $email = $loja->email;
            Mail::send("mail.cadProduto", ["produto" => $produto->nome], function($message) use($email) {
                $message->from("wilk.caetano@gmail.com");
                $message->subject('Cadastro do Produto Realizado');
                $message->to($email);
            });
            $newProduto = [
                "nome" => $produto->nome,
                "valor" => "R$:".intval($produto->valor).",00",
                "loja_id" => $produto->loja_id,
                "ativo" => $produto->ativo
            ];
            return response()->json($newProduto, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
