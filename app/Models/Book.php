<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover',
        'image',
        'author_id',
        'pages',
        'year',
        'language_id',
        'category_id',
        'uuid'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author of the book.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('id');
    }

    public function inWatchlistForUser(User $user) {
        return $user->watchlist->contains('book_id', $this->id);
    }

    public function scopeSearch(Builder $query, ?string $searchTerm): Builder
    {
        return $query->when($searchTerm, function ($query) use ($searchTerm) {
            return $query->where(function ($query) use ($searchTerm) {
                return $query->where(function ($query) use ($searchTerm) {
                    $query->orWhere('title', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('language', function ($query) use ($searchTerm) {
                            $query->where('name', 'LIKE', "%{$searchTerm}%");
                        })
                        ->orWhereHas('category', function ($query) use ($searchTerm) {
                            $query->where('name_en', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('name_ru', 'LIKE', "%{$searchTerm}%");
                        });
                });
            });
        });
    }

    public function scopeMostLiked($query, $limit = 3)
    {
        return $query
            ->with(['author', 'language', 'category']) // Eager load relationships
            ->leftJoin('likes', 'books.id', '=', 'likes.book_id')
            ->groupBy('books.id', 'books.uuid', 'books.title', 'books.description', 'books.cover', 'books.category_id',
                'books.language_id', 'books.image', 'books.author_id', 'books.year', 'books.pages',
                'books.created_at', 'books.updated_at')
            ->havingRaw('COUNT(likes.id) > 0')
            ->orderByDesc(\DB::raw('COUNT(likes.id)'))
            ->select('books.*', \DB::raw('COUNT(likes.id) as like_count'))
            ->limit($limit);
    }
}
