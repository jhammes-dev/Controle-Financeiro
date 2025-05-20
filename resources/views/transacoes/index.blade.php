@extends('layouts.app')

@section('content')
<h1>Minhas Transações</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<p style="color: green;"><strong>Total de Receitas:</strong> R$ {{ number_format($receitas, 2, ',', '.') }}</p>
<p style="color: red;"><strong>Total de Despesas:</strong> R$ {{ number_format($despesas, 2, ',', '.') }}</p>
<p><h4><strong>Saldo:</strong> R$ {{ number_format($saldo, 2, ',', '.') }}</h4></p>



<a href="{{ route('transacoes.create') }}">Nova Transação</a>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Ações</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($transacoes as $transacao)
            <tr>
                <td>{{ $transacao->descricao }}</td>
                <td>R$ {{ number_format($transacao->valor, 2, ',', '.') }}</td>
                <td>{{ ucfirst($transacao->tipo) }}</td>
                <td>{{ \Carbon\Carbon::parse($transacao->data)->format('d/m/Y') }}</td>
                <td>
                    {{-- Botão Editar --}}
                    <a href="{{ route('transacoes.edit', $transacao->id) }}">Editar</a>

                    {{-- Botão Excluir --}}
                    <form action="{{ route('transacoes.destroy', $transacao->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
