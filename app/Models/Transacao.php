<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    // Laravel vai usar automaticamente a tabela "transacaos" se não especificar.
    // Como nossa tabela é "transacoes", precisamos indicar:
    protected $table = 'transacoes';

    // Permitir atribuição em massa para esses campos
    protected $fillable = [
        'descricao',
        'valor',
        'tipo',
        'data',
    ];

    // Opcional: converter o campo 'data' para objeto Carbon automaticamente
    protected $casts = [
        'data' => 'date',
        'valor' => 'decimal:2',
    ];
}
