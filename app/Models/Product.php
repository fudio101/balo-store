<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'avatar',
        'images',
        'detail',
        'producer_id',
        'quantity',
        'quantity_sold',
        'price',
        'status',
    ];
    private mixed $category;

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

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected function images(): Attribute
    {
        return Attribute::get(static function ($value) {
            return explode('#', $value);
        });
    }

    protected function vndPrice(): Attribute
    {
        return Attribute::get(static function ($value, $attributes) {
            return number_format($attributes['price'], 0, '', ',');
        });
    }

    protected function imageUrls(): Attribute
    {
        return Attribute::get(static function ($value, $attributes) {
            $result = $attributes['images'];
            if ($result) {
                $result = array_merge([$attributes['avatar']], explode('#', $result));
            } else {
                $result = [$attributes['avatar']];
            }
            foreach ($result as $key => $item) {
                $result[$key] = filter_var($item,
                    FILTER_VALIDATE_URL) ? $item : Storage::disk('s3')->temporaryUrl($item, now()->addMinutes(5));
            }
            return $result;
        });
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => filter_var($attributes['avatar'],
                FILTER_VALIDATE_URL) ? $attributes['avatar'] : Storage::disk('s3')->temporaryUrl($attributes['avatar'],
                now()->addMinutes(5)),
        );
    }
}
