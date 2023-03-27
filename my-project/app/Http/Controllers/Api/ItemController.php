<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $itens = Item::all();

        if ($itens->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum item encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $itens
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $item = Item::create([
            'descricao' => $request->descricao
        ]);

        if (!$item) {
            return response()->json([
                'status' => 500,
                'data' => 'Não foi possível adicionar o item.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => 'O item foi adicionado com sucesso!'
        ], 200);
    }

    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 404,
                'data' => 'O item informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $item
        ], 200);
    }

    public function edit($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 404,
                'data' => 'O item informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $item
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 404,
                'data' => 'O item informado não foi encontrado.'
            ], 404);
        }

        $item->update([
            'descricao' => $request->descricao
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O item foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 404,
                'data' => 'O item informado não foi encontrado.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O item foi excluido com sucesso!'
        ], 200);
    }
}
