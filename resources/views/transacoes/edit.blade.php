@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Transação</h2>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Corrija os campos abaixo:<br><br>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transacoes.update', $transacao->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Indica que o método HTTP é PUT para update --}}

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ old('descricao', $transacao->descricao) }}" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" step="0.01" name="valor" id="valor" class="form-control" value="{{ old('valor', $transacao->valor) }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Selecione</option>
                <option value="receita" {{ (old('tipo', $transacao->tipo) == 'receita') ? 'selected' : '' }}>Receita</option>
                <option value="despesa" {{ (old('tipo', $transacao->tipo) == 'despesa') ? 'selected' : '' }}>Despesa</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" value="{{ old('data', $transacao->data) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
