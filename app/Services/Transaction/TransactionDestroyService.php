<?php

namespace App\Services\Transaction;

use WpOrg\Requests\Requests;
use App\Exceptions\TransactionNotAuthorizedException;
use App\Models\{User, Transaction};

abstract class TransactionDestroyService
{
	public static function handle(Transaction $transaction)
	{
		$payer = $transaction->payer;
		$payee = $transaction->payee;
		$payer->saldo += (float) $transaction->value;
		$payee->saldo -= (float) $transaction->value;
		$payer->save();
		$payee->save();
		$transaction->delete();
	}
}