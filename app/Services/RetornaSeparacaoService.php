<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RetornaSeparacaoService
{
    public static function emSeparacao($request): array
    {
        try {
            return [
                'status' => true,
                'data' => DB::select('select * from CAACOM.separacao where codfilial in ('.$request->loja.')'),
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
