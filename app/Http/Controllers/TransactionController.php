<?php

namespace App\Http\Controllers;

use App\Models\{User, Transaction};
use Illuminate\Http\Request;
use App\Services\Transaction\{TransactionCreateService, TransactionDestroyService};
use App\Repository\TransactionRepository;
use App\Http\Requests\TransactionStoreRequest;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $repository = TransactionRepository::find($request);
      $transactions = $repository->paginate($request->get('paginate') ?? 15);

      return response()->json($transactions); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)
    {
      try {
        if(TransactionCreateService::handle(User::find($request->get('payer')), User::find($request->get('payee')), $request->get('value')))
        {
          DB::commit();
          return response()->json('Transação efetuado com sucesso.');
        }
      } catch(\Exception $e){
        DB::rollBack();
        return response()->json($e->getMessage(), 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
          TransactionDestroyService::handle($transaction);
          DB::commit();
          return response()->json('Transação deletado com sucesso.');
        } catch(\Exception $e){
          DB::rollBack();
          return response()->json($e->getMessage());
        }
    }
}
