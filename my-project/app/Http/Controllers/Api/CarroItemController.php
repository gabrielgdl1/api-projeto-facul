<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarroItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarroItemController extends Controller
{
    public function index()
    {
        $carrosItens = CarroItem::all();

        if ($carrosItens->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum registro encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $carrosItens
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_carro' => 'required|integer',
            'id_item' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $carroItem = CarroItem::create([
            'id_carro' => $request->id_carro,
            'id_item' => $request->id_item
        ]);

        if (!$carroItem) {
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
        $carroItem = CarroItem::find($id);

        if (!$carroItem) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $carroItem
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_carro' => 'required|integer',
            'id_item' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $carroItem = CarroItem::find($id);

        if (!$carroItem) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $carroItem->update([
            'id_carro' => $request->id_carro,
            'id_item' => $request->id_item
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $carroItem = CarroItem::find($id);

        if (!$carroItem) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $carroItem->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi excluido com sucesso!'
        ], 200);
    }
}
