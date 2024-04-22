<?php

namespace App\Repository\Filtros\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repository\Filtros\BaseFiltro;

class FiltroNome extends BaseFiltro
{
  public function handle(Builder $query, Request $request)
  {
    
    if(!empty($request->get('nome')))
    {
      return $query->where([['nome', 'like', $request->get('nome').'%']]);
    } else {
      return $this->aplicaProximoFiltro($query, $request);
    }
  }
}