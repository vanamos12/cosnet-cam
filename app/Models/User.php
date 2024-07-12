<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Money\Currency;
use Money\Money;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'membershipid',
        'phone',
        'state',
        'town',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
    ];

    public function total():Attribute{
        return Attribute::make(
            get: function(){
                return $this->members->reduce(function(Money $total, Member $item){
                    return $total->add($item->amount);
                }, new Money(0, new Currency('USD')));
            }
        ); 
    }

    public function members():HasMany{
        return $this->hasMany(Member::class);
    }

    public function change_names(): MorphMany
    {
        return $this->morphMany(ChangeName::class, 'change_name_able');
    }

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
