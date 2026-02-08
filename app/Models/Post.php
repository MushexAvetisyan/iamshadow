<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['title', 'user_id', 'language_id', 'post_category_id', 'content', 'image'];

    public $sortable = ['id', 'title', 'language_id'];

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function PostCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function scopeMostLiked($query, $limit = 3)
    {
        return $query
            ->leftJoin('post_likes', 'posts.id', '=', 'post_likes.post_id')
            ->groupBy('posts.id', 'posts.user_id', 'posts.title', 'posts.language_id', 'posts.post_category_id',
                'posts.image', 'posts.content', 'posts.created_at', 'posts.updated_at') // Include all non-aggregated columns
            ->havingRaw('COUNT(post_likes.id) > 0') // Filter only posts with at least one like
            ->orderByDesc(\DB::raw('COUNT(post_likes.id)'))
            ->select('posts.*', \DB::raw('COUNT(post_likes.id) as like_count'))
            ->limit($limit);
    }


    public function inWatchlistForUser(User $user) {
        return $user->watchlist->contains('post_id', $this->id);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('id');
    }

    public function PostComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function PostLikes()
    {
        return $this->hasMany(Like::class);
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
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('language', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('firstname', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('lastname', 'LIKE', "%{$searchTerm}%");
                    });
            });
        });
    }
}
