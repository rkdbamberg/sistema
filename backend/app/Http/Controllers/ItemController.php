<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $item = Item::create($request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria' => 'nullable|string|max:255'
        ]));
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id); // Tenta encontrar o item pelo ID, senão lança 404
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id); // Importe Item se já não o fez: use App\Models\Item;
        try {
            // Valida os dados da requisição
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'descricao' => 'nullable|string',
                'preco' => 'required|numeric|min:0',
                'quantidade' => 'required|integer|min:0',
                'categoria' => 'nullable|string|max:255'
            ]);

            // Atualiza o item com os dados validados
            $item->update($validatedData);

            // Retorna o item atualizado em JSON com um status 200 OK
            return response()->json($item, 200);

        } catch (ValidationException $e) {
            // Se houver erros de validação, retorne-os com status 422 Unprocessable Entity
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Captura qualquer outro erro inesperado
            return response()->json([
                'message' => 'Erro interno do servidor ao atualizar o produto.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->delete();
        return response()->json(null, 204);
    }
}
