<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnuncioController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::all();

        if ($anuncios->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum registro encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $anuncios
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_carro' => 'required|integer',
            'valor' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $anuncio = Anuncio::create([
            'id_usuario' => $request->id_usuario,
            'id_carro' => $request->id_carro,
            'valor' => $request->valor
        ]);

        if (!$anuncio) {
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
        $anuncio = Anuncio::find($id);

        if (!$anuncio) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $anuncio
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|integer',
            'id_carro' => 'required|integer',
            'valor' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $anuncio = Anuncio::find($id);

        if (!$anuncio) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $anuncio->update([
            'id_usuario' => $request->id_usuario,
            'id_carro' => $request->id_carro,
            'valor' => $request->valor
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $anuncio = Anuncio::find($id);

        if (!$anuncio) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $anuncio->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi excluido com sucesso!'
        ], 200);
    }
}
