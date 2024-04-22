<?php

namespace App\Repository\Filtros\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repository\Filtros\BaseFiltro;

class FiltroEmail extends BaseFiltro
{
  public function handle(Builder $query, Request $request)
  {
    
    if(!empty($request->get('email')))
    {
      return $query->where('email', $request->get('email'));
    } else {
      return $this->aplicaProximoFiltro($query, $request);
    }
  }
}