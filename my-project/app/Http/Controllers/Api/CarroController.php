<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarroController extends Controller
{
    public function index()
    {
        $carros = Carro::all();

        if ($carros->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum registro encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $carros
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_marca' => 'required|integer',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'ano' => 'required|string|max:255',
            'tipo_cambio' => 'required|integer',
            'tipo_combustivel' => 'required|integer',
            'tipo_carroceria' => 'required|integer',
            'quilometragem' => 'required|integer',
            'usado' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $carro = Carro::create([
            'id_marca' => $request->id_marca,
            'modelo' => $request->modelo,
            'cor' => $request->cor,
            'ano' => $request->ano,
            'tipo_cambio' => $request->tipo_cambio,
            'tipo_combustivel' => $request->tipo_combustivel,
            'tipo_carroceria' => $request->tipo_carroceria,
            'quilometragem' => $request->quilometragem,
            'usado' => $request->usado
        ]);

        if (!$carro) {
            return response()->json([
                'status' => 500,
                'data' => 'Não foi possível adicionar o registro.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi adicionado com sucesso!'
        ], 200);
    }

    public function show($id)
    {
        $carro = Carro::find($id);

        if (!$carro) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $carro
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_marca' => 'required|integer',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'ano' => 'required|string|max:255',
            'tipo_cambio' => 'required|integer',
            'tipo_combustivel' => 'required|integer',
            'tipo_carroceria' => 'required|integer',
            'quilometragem' => 'required|integer',
            'usado' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $carro = Carro::find($id);

        if (!$carro) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $carro->update([
            'id_marca' => $request->id_marca,
            'modelo' => $request->modelo,
            'cor' => $request->cor,
            'ano' => $request->ano,
            'tipo_cambio' => $request->tipo_cambio,
            'tipo_combustivel' => $request->tipo_combustivel,
            'tipo_carroceria' => $request->tipo_carroceria,
            'quilometragem' => $request->quilometragem,
            'usado' => $request->usado
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $carro = Carro::find($id);

        if (!$carro) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $carro->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi excluido com sucesso!'
        ], 200);
    }
}
