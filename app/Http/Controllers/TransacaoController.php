<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{

    public function index(Request $request)
{
    $query = Transacao::query();

    // Filtra por tipo, se informado
    if ($request->filled('tipo')) {
        $query->where('tipo', $request->tipo);
    }

    // Filtra por intervalo de datas, se informado
    if ($request->filled('data_inicio')) {
        $query->where('data', '>=', $request->data_inicio);
    }

    if ($request->filled('data_fim')) {
        $query->where('data', '<=', $request->data_fim);
    }

    $transacoes = $query->get();

    // Calcula receitas, despesas e saldo
    $receitas = $transacoes->where('tipo', 'receita')->sum('valor');
    $despesas = $transacoes->where('tipo', 'despesa')->sum('valor');
    $saldo = $receitas - $despesas;

    return view('transacoes.index', compact('transacoes', 'receitas', 'despesas', 'saldo'));
    }

    public function create()
    {
        return view('transacoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'valor'     => 'required|numeric',
            'tipo'      => 'required|in:receita,despesa',
            'data'      => 'required|date',
        ]);

        Transacao::create($request->all());

        return redirect()->route('home')->with('success', 'Transação registrada com sucesso!');
    }

    public function edit($id){
    $transacao = transacao::findOrFail($id);
    return view('transacoes.edit', compact('transacao'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required',
            'valor'     => 'required|numeric',
            'tipo'      => 'required|in:receita,despesa',
            'data'      => 'required|date',
        ]);

        $transacao = transacao::findOrFail($id);
        $transacao->update($request->all());

        return redirect()->route('home')->with('success', 'Transação atualizada com sucesso!');
    }

    public function destroy($id){
    $transacao = transacao::findOrFail($id);
    $transacao->delete();

    return redirect()->route('home')->with('success', 'Transação excluída com sucesso!');
    }


}
