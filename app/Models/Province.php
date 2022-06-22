<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    /**
     * Get the districts for the blog post.
     */
    final public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
