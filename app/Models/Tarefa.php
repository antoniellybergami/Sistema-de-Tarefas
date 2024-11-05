<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tarefa;

class Tarefa extends Model
{
    protected $fillable = [
        'nome',
        'custo',
        'data',
        'ordem'
      ];
}
