<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class UserRepository
{
  public static function find(Request $request) : Builder
  {
    $orderBy = request()->get('orderby');
    $query_builder = User::orderBy($orderBy['attribute'] ?? 'id_user', $orderBy['tipo'] ?? 'desc');
    return $query_builder;
  }
}
