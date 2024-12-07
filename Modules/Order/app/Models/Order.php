<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Observers\OrderObserver;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class, 'order_meal')->using(OrderMeal::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Order\Database\Factories\OrderFactory::new();
    }

    public function getMealsNamesAttribute(): string
    {
        return $this->meals->implode('name', ', ');
    }
}
