<?php

namespace App\Services\Transaction;

use App\Models\User;
use WpOrg\Requests\Requests;
use App\Exceptions\TransactionNotificationException;

abstract class TransactionNotificationService
{
	public static function handle(User $payee)
	{
		$headers = array('Accept' => 'application/json');
        $request = Requests::get('https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6', $headers);
        if($request->status_code == 200)
        {
          $body = json_decode($request->body);
          if(!$body->message)
	      {
	        throw new TransactionNotificationException("O serviço de notificação externa encontra-se temporariamente indisponível.", 500);
	      }
        } else {
        	throw new TransactionNotificationException("O serviço de notificação externa encontra-se temporariamente indisponível.", 500);
        }

        
        return true;
	}
}