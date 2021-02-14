<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wink\WinkAuthor;
use Wink\WinkPage;
use Wink\WinkPost;
use Wink\WinkTag;

class BlogController extends Controller
{
    public function index()
    {
        if ($slug = request('by')) {
            $author = WinkAuthor::whereSlug($slug)->first();
        }
        $posts = WinkPost::Published()->latest()->with(['tags', 'author'])->when(request('by'), function ($query) {
            return $query->whereHas("author", function ($author) {
                return $author->where("wink_authors.slug", request('by'));
            });
        })->paginate(8);
        return view('site.blog.index', get_defined_vars());
    }

    public function showPost(WinkPost $post)
    {
        abort_unless(auth()->guard('wink')->check() || $post->published, 404);
        $post->load(['tags', 'author']);
        $metaData = (object)$post->meta;
        meta()
            ->when(isset($metaData->meta_description), function ($meta) use ($metaData) {
                $meta->set('description', $metaData->meta_description);
            })
            ->when(isset($metaData->opengraph_title), function ($meta) use ($metaData) {
                $meta->set('og:title', $metaData->opengraph_title);
            })
            ->when(isset($metaData->opengraph_description), function ($meta) use ($metaData) {
                $meta->set('og:description', $metaData->opengraph_description);
            })
            ->when(isset($metaData->opengraph_image), function ($meta) use ($metaData) {
                $meta->set('og:image', asset($metaData->opengraph_image));
            })
            ->when(isset($metaData->opengraph_image_width), function ($meta) use ($metaData) {
                $meta->set('og:image:width', $metaData->opengraph_image_width);
            })
            ->when(isset($metaData->opengraph_image_height), function ($meta) use ($metaData) {
                $meta->set('og:image:height', $metaData->opengraph_image_height);
            })
            ->when(isset($metaData->twitter_title), function ($meta) use ($metaData) {
                $meta->set('twitter:title', $metaData->twitter_title);
            })
            ->when(isset($metaData->twitter_description), function ($meta) use ($metaData) {
                $meta->set('twitter:description', $metaData->twitter_description);
            })
            ->when(isset($metaData->twitter_image), function ($meta) use ($metaData) {
                $meta->set('twitter:image', asset($metaData->twitter_image));
            })
            ->noIndex();
        return view('site.blog.posts.show', get_defined_vars());
    }


    public function showAuthor(WinkAuthor $author)
    {
        return redirect()->action("Site\BlogController@index", ['by' => $author->slug]);
    }

    public function showTag(WinkTag $tag)
    {
        $tag->load(['posts' => function ($posts) {
            return $posts->Published()->with(['tags']);
        }]);
        return view('site.blog.tags.show', get_defined_vars());
    }

    public function tags()
    {
        $tags = WinkTag::latest()->get();
        return view('site.blog.tags.index', get_defined_vars());
    }
}
