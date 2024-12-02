<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->using(OrderMeal::class);
    }
}
