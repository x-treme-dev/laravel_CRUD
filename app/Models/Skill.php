<?php

namespace App\Models;

use App\Models\Customer;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Skill extends Model
{
    use HasFactory;

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany( Customer::class );
    }

}
