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
      'sender',
      'receiver',
      'amount'
    ];

    public function sender()
    {
      return $this->hasOne(User::class, 'id_user', 'sender');
    }

    public function receiver()
    {
      return $this->hasOne(User::class, 'id_user', 'receiver');
    }

}
