<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
      'id_payer',
      'id_payee',
      'value'
    ];

    // Pagador(a)
    public function payer()
    {
      return $this->hasOne(User::class, 'id_user', 'id_payer');
    }

    // Beneficiário(a)
    public function payee()
    {
      return $this->hasOne(User::class, 'id_user', 'id_payee');
    }

}
