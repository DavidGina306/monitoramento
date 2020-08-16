<?php

namespace App\Http\Controllers;

use App\Services\RetornaExpedicaoService;
use App\Services\RetornaSeparacaoService;
use Illuminate\Http\Request;

class MonitaramentoController extends Controller
{
    public function index(Request $request)
    {
       return view('welcome');
    }

    /**
     * Função para retornar pedidos em Expedicao
     *
     * @param Request $request
     * @return void
     */
    public function emExpedicao(Request $request)
    {
        $result = RetornaExpedicaoService::emExpedicao($request);
        return response()->json($result, $result['status'] ? 200: 500);
    }

    /**
     *  Função para retornar pedidos em Expedicao
     *
     * @param Request $request
     * @return void
     */
    public function emSeparacao(Request $request)
    {
        $result = RetornaSeparacaoService::emSeparacao($request);
        return response()->json($result, $result['status'] ? 200: 500);
    }

}
