<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RetornaExpedicaoService
{
    public static function emExpedicao($request): array
    {
        try {
            return [
                'status' => true,
                'data' => DB::select('select * from CAACOM.expedicao  where codfilial in ( '.$request->loja.')  order by tempo desc'),
                'msg' => 'Sucesso!'
            ];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return [
                'status' => false,
                'data' => [],
                'msg' => 'Erro ao buscar pedidos em Expedição'
            ];
        }
    }
}
