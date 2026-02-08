<?php

namespace App\Services\Post;

use App\Http\Requests\PostRequest;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\TestFixture\func;

class PostService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function getViewData(Request $request): array
    {
        return [
            'posts' => Post::with('language')
                ->with('user')
                ->search($request->get('search'))
                ->with('likes')
                ->with('comments')
                ->sortable()
                ->ordered()
                ->paginate(8),
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public static function show(int $id): array
    {
        return[
         'post' => Post::with('comments')->with('likes')->find($id)
        ];
    }

    /**
     * @param PostRequest $request
     * @return void
     */
    public static function store(Request $request): void
    {
        $request->validated();

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = public_path('storage/postImages/');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $input['user_id'] = auth()->id();
        $input['content'] = strip_tags($request->input('content'));


        Post::create($input);
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return void
     */
    public static function update(PostRequest $request, Post $post): void
    {
        $request->validated();

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = public_path('storage/postImages/');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $post->update($input);
    }

    /**
     * @param Post $post
     * @return array
     */
    public static function edit(Post $post): array
    {
        return[
            'languages' => Language::all(),
            'PostCategories' => PostCategory::all(),
            'post' => $post
        ];
    }

    /**
     * @param Post $post
     * @return void
     */
    public static function destroy(Post $post): void
    {
        Storage::delete('storage/images/' . $post->image);
        $post->delete();
    }

    /**
     * @param $languageName
     * @return array
     */
    public static function postsByLanguage($languageName): array
    {
        $language = Language::where('name', $languageName)->firstOrFail();
        return[
            'posts' => Post::where('language_id', $language->id)->paginate(10)
        ];
    }
}
