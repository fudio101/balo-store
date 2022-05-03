<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'limit_number',
        'number_used',
        'payment_limit',
        'expiration_date',
        'description',
    ];

    protected static function boot()
    {

        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id ?? 1;
            }
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

    protected function expirationDay(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attribute) => now()->diffInDays($attribute['expiration_date']),
        );
    }

    protected function expirationDate(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => date('Y-m-d', strtotime($value))
        );
    }
}
