<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

    /**
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('id');
    }

    /**
     * @param Builder $query
     * @param string|null $searchTerm
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $searchTerm): Builder
    {
        return $query->when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }
}
