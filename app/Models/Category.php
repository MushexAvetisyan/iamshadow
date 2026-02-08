<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name_en',
        'name_ru',
    ];

    /**
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @param $query
     * @return Builder
     */
    public function scopeOrdered($query): Builder
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
            return $query->where(function ($query) use ($searchTerm) {
                $query->where('name_en', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('name_ru', 'LIKE', "%{$searchTerm}%");
            });
        });
    }
}
