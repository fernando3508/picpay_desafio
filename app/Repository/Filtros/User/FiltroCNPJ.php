<?php

namespace App\Repository\Filtros\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repository\Filtros\BaseFiltro;

class FiltroCNPJ extends BaseFiltro
{
  public function handle(Builder $query, Request $request)
  {
    
    if(!empty($request->get('cnpj')))
    {
      return $query->where('cnpj', $request->get('cnpj'));
    } else {
      return $this->aplicaProximoFiltro($query, $request);
    }
  }
}