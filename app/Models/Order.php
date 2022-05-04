<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'name',
        'phone',
        'email',
        'total',
        'shipping_cost',
        'coupon',
        'district_id',
        'detailed_address',
        'order_status_id',
    ];

    protected static function boot()
    {

        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id ?? 1;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id ?? 1;
            }
        });
    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        $district = $this->belongsTo(District::class, 'district_id')->get()[0];
        $province = $district->belongsTo(Province::class, 'province_id')->get()[0];

        return $this->detailed_address.', '.$district->name.', '.$province->name;
    }
}
