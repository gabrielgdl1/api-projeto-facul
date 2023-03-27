<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        if ($usuarios->count() == 0) {
            return response()->json([
                'status' => 404,
                'data' => 'Nenhum registro encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $usuarios
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'required|string|max:255',
            'telefone' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $usuario = Usuario::create([
            'usuario' => $request->usuario,
            'email' => $request->email,
            'senha' => $request->senha,
            'telefone' => $request->telefone
        ]);

        if (!$usuario) {
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
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $usuario
        ], 200);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'required|string|max:255',
            'telefone' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'data' => $validator->messages()
            ], 422);
        }

        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $usuario->update([
            'usuario' => $request->usuario,
            'email' => $request->email,
            'senha' => $request->senha,
            'telefone' => $request->telefone
        ]);

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi alterado com sucesso!'
        ], 200);
    }

    public function delete($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 404,
                'data' => 'O registro informado não foi encontrado.'
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'status' => 200,
            'data' => 'O registro foi excluido com sucesso!'
        ], 200);
    }
}
