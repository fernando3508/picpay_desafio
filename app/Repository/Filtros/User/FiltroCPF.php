<?php

namespace App\Repository\Filtros\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repository\Filtros\BaseFiltro;

class FiltroCPF extends BaseFiltro
{
  public function handle(Builder $query, Request $request)
  {
    
    if(!empty($request->get('cpf')))
    {
      return $query->where('cpf', $request->get('cpf'));
    } else {
      return $this->aplicaProximoFiltro($query, $request);
    }
  }
}