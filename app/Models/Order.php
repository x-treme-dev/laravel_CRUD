<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Customer;

class Order extends Model
{
    //protected $fillable = [];
    protected $guarded = false;
    const STATUSES = ['Placed', 'Paid', 'Cancelled'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'firstname' => 'Anonymous'
        ]);
    }
}
