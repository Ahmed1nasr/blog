<?php

namespace App\Http\Controllers\Api\V1\Wink;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(['image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:' . (1024 * 10)]]);
        $path = request()->file('image')->store(
            config('wink.storage_path'),
            [
                'disk' => config('wink.storage_disk'),
                'visibility' => 'public',
            ]
        );
        $url = Storage::disk(config('wink.storage_disk'))->url($path);
        return response()->json([
            'url' => $url,
            'full_url' => asset($url)
        ]);
    }
}
