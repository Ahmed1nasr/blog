<?php

namespace App\Http\Controllers\Api\V1\Wink\User;

use App\Http\Controllers\Controller;
use App\Services\Wink\WinkPage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = WinkPage::latest()->paginate(10);
        return response()->json($pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:100'],
            'body' => ['nullable', 'max:999999'],
            'slug' => ['nullable', 'max:100']
        ]);

        $page = WinkPage::create([
            'title' => $request->title,
            'body' => $request->body ?? '',
            'slug' => $request->slug,
        ]);

        return response()->json(['data' => $page], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WinkPage $page)
    {
        return response()->json(['data' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WinkPage $page)
    {
        $request->validate([
            'title' => ['sometimes', 'string', 'min:2', 'max:100'],
            'body' => ['sometimes', 'max:999999'],
            'slug' => ['sometimes', 'unique:wink_pages,slug,' . $page->id . ',id', 'max:100']
        ]);

        $page->update([
            'title' => $request->title,
            'body' => $request->body ?? '',
            'slug' => $request->slug,
        ]);

        return response()->json(['data' => $page]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WinkPage $page)
    {
        $page->delete();
        return response()->noContent();
    }
}
