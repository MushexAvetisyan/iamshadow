<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class Language extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'code',
    ];

    public $sortable = ['id', 'name', 'code'];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('id');
    }

    /**
     * @return HasMany
     */
    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
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
                $query->where('name', 'LIKE', "%{$searchTerm}%");
            });
        });
    }
}
