<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    CONST LOJISTA = 'l';
    CONST USUARIO_COMUM = 'c';

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'tipo',
        'saldo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function tipo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value == self::LOJISTA ? 'lojista' : 'usuário',
            set: fn (string $value) => strtolower($value) == 'lojista' ? self::LOJISTA : self::USUARIO_COMUM,
        );
    }

    // Pagamentos
    public function payments()
    {
      return $this->hasMany(Transaction::class, 'id_payer', $this->primaryKey)->withTrashed();
    }

    // Cobranças
    public function charges()
    {
      return $this->hasMany(Transaction::class, 'id_payee', $this->primaryKey)->withTrashed();
    }
}
