<?php

namespace App\Http\Controllers;

use App\Loja;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class lojaController extends Controller
{
    private $loja;

    public function __construct(Loja $loja)
    {
        header('Acess-Control-Allow-Origin: *');
        $this->loja = $loja;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loja = Loja::all();
        if (count($loja) > 0) {
            return response()->json($loja, 200);
        } else {
            return response()->json("Não há lojas cadastradas", 400);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->loja->rules, $this->loja->message);
        if ($validate->fails()) {
            return response()
                ->json($validate->errors(), 400);
        } else {
            $loja = $this->loja;
            $loja->nome_da_loja = $request->post("nome_da_loja");
            $loja->email = $request->post("email");
            $loja->save();
            return response()->json($loja, 201);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $loja = $this->loja->find($id);
        if ($loja)
            return response()->json($loja, 200);
        else
            return response()->json("Loja não encontrado", 404);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator($request->all(), $this->loja->rulesUpdate, $this->loja->message);
        if ($validate->fails()) {
            return response()
                ->json($validate->errors(), 400);
        } else {
            $loja = $this->loja->find($id);
            if ($loja) {
                $dados = $request->all();
                $loja->update($dados);
                return response()->json($loja, 201);
            } else {
                return response()->json("Loja não encontrado", 404);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loja = $this->loja->find($id);
        if ($loja) {
            $loja->delete();
            return response()->json("Loja deletada com sucesso", 200);
        } else
            return response()->json("Loja não encontrada", 404);
    }
}

