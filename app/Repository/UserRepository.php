<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\Filtros\User\{FiltroNome, FiltroEmail, FiltroTipo, FiltroCNPJ, FiltroCPF};

abstract class UserRepository
{
  public static function find(Request $request) : Builder
  {
    $orderBy = request()->get('orderby');
    $query_builder = User::orderBy($orderBy['attribute'] ?? 'id_user', $orderBy['tipo'] ?? 'desc');

    $filtros = new FiltroNome();
    $filtros->adcFiltro(new FiltroEmail())
      ->adcFiltro(new FiltroTipo())
      ->adcFiltro(new FiltroCPF())
      ->adcFiltro(new FiltroCNPJ());

    return $filtros->handle($query_builder, $request);
  }
}
