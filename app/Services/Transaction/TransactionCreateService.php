<?php

namespace App\Services\Transaction;

use WpOrg\Requests\Requests;
use App\Exceptions\TransactionNotAuthorizedException;
use App\Models\{User, Transaction};

abstract class TransactionCreateService
{
  public static function handle(User $payer, User $payee, $value)
  {
    if($payer->tipo == 'lojista')
    {
        throw new TransactionNotAuthorizedException('Usuários do tipo lojista não têm permissão para efetuar pagamentos.', 500);
    }

    if($payer->getKey() == $payee->getKey())
    {
      throw new TransactionNotAuthorizedException('Os usuários não possuem permissão para realizar transações na mesma conta.', 500);
    }

    if($payer->saldo <= 0 || $payer->saldo < $value)
    {
        throw new TransactionNotAuthorizedException('Saldo do usuário é insuficiente.', 500);
    }

    self::TransactionAuthorized();
    $transaction = Transaction::create(['id_payee' => $payee->getKey(), 'id_payer' => $payer->getKey(), 'value' => $value]);
    $payer->saldo -= (float) $value;
    $payee->saldo += (float) $value;
    $payer->save();
    $payee->save();
    TransactionNotificationService::handle($payee);

    return true;
  }

  public static function TransactionAuthorized()
  {
    $headers = array('Accept' => 'application/json');
    $request = Requests::get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc', $headers);

    if($request->status_code == 200)
    {
      $body = json_decode($request->body);
      if($body->message != 'Autorizado')
      {
        throw new TransactionNotAuthorizedException("Transação não autorizada.", 500);
      }
    } else {
        throw new TransactionNotAuthorizedException("O serviço autorizador externo está atualmente inoperante.", 500);
    }
  }
}
