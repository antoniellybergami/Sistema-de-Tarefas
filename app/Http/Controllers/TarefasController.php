<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TarefasController extends Controller
{

    public function reordenar(Request $request)
    {
        $ordem = $request->input('ordem');

        foreach ($ordem as $index => $id) { //pega o id que vem da lista de ids ordenados
            if (Tarefa::find($id)) {
                Tarefa::where('id', $id)->update(['ordem' => $index ]); //como o array vem ordenado, o indice já é a ordem
            } else {
                return response()->json(['message' => 'Tarefa não encontrada: ' . $id], 422);
            }
        }
    
        return response()->json(['message' => 'Tarefas reordenadas com sucesso!']);
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefa::orderBy('ordem')->get();
        return view("tarefas.index", compact("tarefas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'custo' => 'required',
            'data' => 'required',
          ]);

          $ordem = Tarefa::max('ordem') !== null ? Tarefa::max('ordem') + 1 : 1;

          Tarefa::create(array_merge($request->all(), ['ordem' => $ordem]));

          return redirect()->route('tarefas.index')
            ->with('success','Tarefa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarefas = Tarefa::where('id', $id);

        if(!$tarefas){
            return redirect()->back()->with('error', 'Tarefa não encontrada');
        }
        return view('tarefas.index', compact('tarefas'));
    }

    public function edit($id)
    {
        $tarefa = Tarefa::find($id);

        return view('tarefas.edit', compact('tarefa'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'custo' => 'required',
            'data' => 'required',
    
        ]);

        $nomeExiste = Tarefa::where('nome', $request->nome)->where('id', '!=' ,$id)->first(); //verifica se o nome já existe em algum tarefa, mas se for a da própria tarefa pode

        if ($nomeExiste) {
            return redirect()->back()
                ->with('error', 'O nome da tarefa já existe. Escolha um nome diferente.');
        }

        $tarefa = Tarefa::find($id);
        $tarefa->update($request->all());

        return redirect()->route('tarefas.index')
            ->with('success','tarefa atualizado com suucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarefa = Tarefa::find($id);
        $tarefa->delete();

        return redirect()->route('tarefas.index')
        ->with('success', 'tarefa deletada com sucesso.');
    }

    public function create()
    {
      return view('tarefas.create');
    }
}
