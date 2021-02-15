<?php

namespace App\Http\Controllers\Api\V1\Wink;

use App\Http\Controllers\Controller;
use App\Services\Wink\WinkPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function posts(Request $request)
    {
        $posts = WinkPost::latest()
            ->when($request->has('title'), function (Builder $builder) {
                return $builder->where('title', 'like', "%" . request('title') . "%");
            })
            ->when($request->has('body'), function (Builder $builder) {
                return $builder->where('body', 'like', "%" . request('body') . "%");
            })
            ->when($request->has('tags'), function (Builder $builder) {
                return $builder->whereHas('tags', function (Builder $tagsBuilder) {
                    return $tagsBuilder->whereIn('id', request('tags'));
                });
            })
            ->when($request->has('author_id'), function (Builder $builder) {
                return $builder->where('author_id', request('author_id'));
            })
            ->when($request->has('status'), function (Builder $builder) {
                switch (request('status')) {
                    case 'live':
                        return $builder->Live();
                        break;
                    case 'published':
                        return $builder->Published();
                        break;
                    case 'scheduled':
                        return $builder->Scheduled();
                        break;
                    case 'draft':
                        return $builder->Draft();
                        break;
                }
            })
            ->paginate(10);
        return response()->json($posts);
    }
}
