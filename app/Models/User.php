<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tel',
        'is_admin',
        'user_id',
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

    
    /* Relacionamento com o Wallet (um para um).
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Relacionamento com o Bank (um para um).
     */
    public function bank()
    {
        return $this->hasOne(Bank::class);
    }

    /**
     * Relacionamento com o ProductUser (um para muitos).
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_users')
            ->withPivot('income_total', 'last_collection', 'expires_at')
            ->withTimestamps();
    }

    /**
     * Relacionamento auto-referencial (um usuário pode ter um superior).
     */
    public function superior()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento inverso de superior, onde um usuário pode ter muitos subordinados.
     */
    public function subordinates()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    /**
     * Superiores de nível 1 e 2 (relacionamento recursivo).
     */
    public function superiors1()
    {
        return $this->superior()->get();
    }

    public function superiors2()
    {
        return $this->superiors1()->flatMap(function ($superior) {
            return $superior->superior;
        });
    }

    /**
     * Subordinados de nível 1 e 2.
     */
    public function subordinates1()
    {
        return $this->subordinates;
    }

    public function subordinates2()
    {
        return $this->subordinates1()->flatMap(function ($subordinate) {
            return $subordinate->subordinates;
        });
    }
}
