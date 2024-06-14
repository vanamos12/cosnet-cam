<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ChangeName extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'change_name_able_id',
        'change_name_able_type'
    ];

    public function change_name_able(): MorphTo
    {
        return $this->morphTo();
    }
}
