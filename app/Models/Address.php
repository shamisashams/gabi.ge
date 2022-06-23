<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'country',
        'city',
        'phone',
        'postal_code',
        'address_1',
        'address_2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
