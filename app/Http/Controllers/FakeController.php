<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class FakeController extends Controller
{
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }


    public function separacaoExpedicao()
    {
        return response()->json([
            'separacao' => $this->separacao(),
            'expedicao' => $this->expedicao()
        ]);
    }


    private function expedicao()
    {
        $disponiveis = array_values(session('pedidos_disponiveis_remocao') ?? []);
        if (count($disponiveis) > 0 && mt_rand(0, 10) > 6) {
            unset($disponiveis[mt_rand(0, count($disponiveis) - 1)]);
        }
        return  array_values($disponiveis);

    }

    private function separacao()
    {
        if (session('pedidos')) {
            if (Arr::random(['R', 'A']) === 'R') {
                $this->remove();
            } else {
                $this->add();
            }
        } else {
            $this->add();
        }
        return array_values(session('pedidos'));
    }

    private function remove()
    {
        for ($i = 0; $i < mt_rand(1, 2); $i++) {
            $pedidos = array_values(session('pedidos'));
            $position = mt_rand(0, count($pedidos));
            if ($position > 0) {
                $pedidoDisponivelRemocao = $pedidos[$position - 1];
                unset($pedidos[$position - 1]);
                session()->forget('pedidos');
                session()->put('pedidos', $pedidos);
                session()->push('pedidos_disponiveis_remocao', $pedidoDisponivelRemocao);
                session()->save();
            }
        }
    }

    private function add()
    {
        for ($i = 0; $i < mt_rand(1, 2); $i++) {
            session()->push('pedidos', [
                'numped' => time() * mt_rand(0, 100),
                'cliente' => $this->faker->name
            ]);
            session()->save();
        }
    }
}
