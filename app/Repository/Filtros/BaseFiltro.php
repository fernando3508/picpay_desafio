<?php

namespace App\Repository\Filtros;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFiltro implements IFiltro
{
  protected $proximoFiltro;
  public function adcFiltro(IFiltro $filtro) : IFiltro
  {
    $this->proximoFiltro = $filtro;
    return $this->proximoFiltro;
  }

  public function aplicaProximoFiltro(Builder $query, Request $request)
  {
    if(!empty($this->proximoFiltro))
    {
      return $this->proximoFiltro->handle($query, $request);
    }
    return $query;
  }
}