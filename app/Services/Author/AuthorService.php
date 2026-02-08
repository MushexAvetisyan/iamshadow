<?php

namespace App\Services\Author;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function GetViewData(Request $request): array
    {
        return [
            'authors' => Author::withCount('books') // Add withCount to get the book count
            ->search($request->get('search'))
                ->latest()
                ->paginate(7),
            'NewAuthors' => Author::orderBy('created_at', 'desc')->take(3)->get(),
        ];
    }

    public static function create(AuthorRequest $request)
    {
        $request->validated();
        $authorData = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('authors', 'public'); // Store in 'storage/app/public/authors'
            $authorData['image'] = $imagePath;
        }
        // Strip HTML tags from description before saving
        $authorData['description'] = strip_tags($request->input('description'));
        Author::create($authorData);
    }

    /**
     * @param Author $author
     * @return array
     */
    public static function edit(Author $author): array
    {
        return[
            'author' => $author
        ];
    }

    public static function update(AuthorRequest $request, Author $author)
    {
        $request->validated();

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $input['image'] = $request->file('image')->store('authors', 'public');
        }
        $input['description'] = strip_tags($request->input('description'));
        $author->update($input);
    }

    public static function destroy(Author $author)
    {
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }

        $author->delete();
    }

    /**
     * @param $authorName
     * @return array
     */
    public static function booksByAuthors($authorName): array
    {
        $author = Author::where('name', $authorName)->firstOrFail();
        $books = Book::where('author_id', $author->id)->with('category', 'language')->paginate(10);

        return compact('author', 'books');
    }
}
