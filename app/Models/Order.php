<?php

namespace App\Models;

use App\Traits\ScopeOrderFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends Model
{
    use HasFactory, ScopeOrderFilter;

    const STATUS_PENDING = 3;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;

    protected $fillable = [
        'bank_id',
        'user_id',
        'payment_type_id',
        'transaction_id',
        'shipment_price',
        'shipment_comment',
        'total_price',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'country'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct', 'order_id');
    }

    public function totalprice()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }

    public function loan()
    {
        return $this->morphOne('App\Models\Loan', 'loanable');
    }

    public function tbcLoan(): MorphOne
    {
        return $this->morphOne(TbcLoan::class, 'tbcloanable');
    }

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, 'id', 'payment_type_id');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'total_price' => [
                'hasParam' => true,
                'scopeMethod' => 'totalPrice'
            ],
            'email' => [
                'hasParam' => true,
                'scopeMethod' => 'email'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }
}
