<?php

namespace App\Repository;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class TransactionRepository
{
  public static function find(Request $request) : Builder
  {
    $orderBy = request()->get('orderby');
    $query_builder = Transaction::orderBy($orderBy['attribute'] ?? 'id_transaction', $orderBy['tipo'] ?? 'desc');
    return $query_builder;
  }
}
