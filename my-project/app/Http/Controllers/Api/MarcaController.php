<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();

        if ($marcas->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum registro encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $marcas
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $marca = Marca::create([
            'nome' => $request->nome
        ]);

        if (!$marca) {
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
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $marca
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $marca->update([
            'nome' => $request->nome
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $marca->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi excluido com sucesso!'
        ], 200);
    }
}
