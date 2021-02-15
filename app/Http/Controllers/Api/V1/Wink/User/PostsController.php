<?php

namespace App\Http\Controllers\Api\V1\Wink\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wink\User\PostsRequest;
use App\Services\Wink\WinkPost;
use App\Services\Wink\WinkTag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = auth()->user()->posts()->with(['author'])->latest()->paginate(10);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $data = collect([
            'title' => request('title'),
            'excerpt' => request('excerpt', ''),
            'slug' => request('slug', SlugService::createSlug(WinkPost::class, 'slug', request('title'))),
            'body' => request('body', ''),
            'markdown' => false,
            'author_id' => auth()->id(),
            'featured_image_caption' => request('featured_image_caption', ''),
            'published' => request('published', false),
            'publish_date' => request('publish_date') ?? now(),
            'meta' => request('meta', (object) []),
        ]);

        $post = new WinkPost();
        if ($request->has('featured_image')) {
            $path = $request->file('featured_image')->store(
                config('wink.storage_path'),
                [
                    'disk' => config('wink.storage_disk'),
                    'visibility' => 'public',
                ]
            );
            $data->put("featured_image", Storage::disk(config('wink.storage_disk'))->url($path));
        }

        $post->fill($data->toArray());
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->sync(request('tags'));
        }

        return response()->json([
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WinkPost $post)
    {
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, WinkPost $post)
    {
        $data = collect([
            'title' => request('title', $post->title),
            'excerpt' => request('excerpt', $post->excerpt),
            'slug' => request('slug', $post->slug),
            'body' => request('body', $post->getAttributes()['body']),
            'featured_image_caption' => request('featured_image_caption', $post->featured_image_caption),
            'published' => request('published', false),
            'publish_date' => request('publish_date') ?? now(),
            'meta' => request('meta', (object) []),
        ]);

        if ($request->has('featured_image')) {
            $path = $request->file('featured_image')->store(
                config('wink.storage_path'),
                [
                    'disk' => config('wink.storage_disk'),
                    'visibility' => 'public',
                ]
            );
            $data->put("featured_image", Storage::disk(config('wink.storage_disk'))->url($path));
        }

        $post->update($data->toArray());

        if ($request->has('tags')) {
            $post->tags()->sync(request('tags'));
        }

        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WinkPost $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
