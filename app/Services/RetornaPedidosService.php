<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RetornaPedidosService
{
    public static function retornaPedidos($request): array
    {
        try {
            $data = [
                'separacao' => DB::select('select * from CAACOM.separacao where codfilial in ('.$request->loja.')'),
                'expedicao' =>  DB::select('select * from CAACOM.expedicao  where codfilial in ( '.$request->loja.')  order by tempo desc')
            ];
            return [
                'status' => true,
                'data' => $data,
                'msg' => 'Sucesso!'
            ];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return [
                'status' => false,
                'data' => [],
                'msg' => 'Erro ao buscar pedidos em Separacão'
            ];
        }
    }
}
