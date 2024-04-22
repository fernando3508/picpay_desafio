<?php

namespace App\Repository\Filtros\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repository\Filtros\BaseFiltro;

class FiltroTipo extends BaseFiltro
{
  public function handle(Builder $query, Request $request)
  {
    $tipos = [
      'lojista' => 'l',
      'usuario' => 'c',
      'usuário' => 'c'
    ];
    
    $tipo = !empty($request->get('tipo')) ? $tipos[$request->get('tipo')] : NULL;

    if(!empty($tipo))
    {
      return $query->where('tipo', $tipo);
    } else {
      return $this->aplicaProximoFiltro($query, $request);
    }
  }
}