<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Loja;
use App\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class produtosController extends Controller
{

    private $produto;
    private $totalPage = 10;

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
        $produto = $this->produto->paginate($this->totalPage);
        if (count($produto) > 0) {
            $newProduto = collect(Helper::valorProdutos($produto));
            $data = $newProduto->merge($produto);
            return response()->json($data,  200);
        }
        else {
            return response()->json("Não há produtos cadastradas", 400);

        }
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
 //           $loja = Loja::find($produto->loja_id);
//          $email = $loja->email;                            Não consegui a liberação do envio de email junto ao servidor porem o código está aqui.
//          Helper::enviMail($email, "Produto Cadastrado");
            $newProduto = Helper::valor($produto);
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
        $produto = $this->produto->find($id);
        if ($produto) {
            $newProduto = Helper::valor($produto);
            return response()->json($newProduto, 200);
        }
        else{
            return response()->json("Produto não encontrado", 404);
        }

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
        $validate = validator($request->all(), $this->produto->rules, $this->produto->message);
        if ($validate->fails()) {
            return response()
                ->json($validate->errors(), 400);
        } else {
            $loja = Loja::find($request->post("loja_id"));
            if (!empty($loja->nome_da_loja)) {
                $produto = Produtos::find($id);
                if(!empty($produto->nome)) {
                    $dados = $request->all();
                    $produto->update($dados);
                    $objectProduto = Helper::valor($produto);
                } else{
                    return  response()->json("Produto não cadastrado e/ou deletado do sistema");
                }

                return response()->json($objectProduto, 201);

            } else {
                return response()->json("Loja não cadastrada ou deletada em nossa base de dados", 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = $this->produto->find($id);
        if ($produto) {
            $produto->delete();
            return response()->json("Produto deletado com sucesso", 200);
        } else
            return response()->json("Produto não encontrado", 404);
    }
}
