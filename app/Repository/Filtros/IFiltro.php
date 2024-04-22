<?php

namespace App\Repository\Filtros;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface IFiltro
{
  public function adcFiltro(IFiltro $filtro) : IFiltro;
  public function handle(Builder $query, Request $request);
}