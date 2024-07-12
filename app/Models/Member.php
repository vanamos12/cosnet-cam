<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Money\Currency;
use Money\Money;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'membershipid',
        'cni_number',
        'town',
        'birthday',
        'phone',
        'email',
        'cni_recto',
        'cni_verso'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function payments():HasMany{
        return $this->hasMany(Payment::class);
    }

    public function change_names(): MorphMany
    {
        return $this->morphMany(ChangeName::class, 'change_name_able');
    }

    protected function amount():Attribute{
        return Attribute::make(
            get:function(){
                $value = $this->payments()->where('status', 'Not Paid')->sum('amount');
                return new Money($value, new Currency('USD')); 
            },
        );
    }
}
