<?php

namespace App\Http\Controllers\Api\V1\Wink\User;

use App\Http\Controllers\Controller;
use App\Services\Wink\WinkTag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = WinkTag::latest()->paginate(10);
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'min:2', 'max:100']]);
        $tag = WinkTag::create($data);
        return response()->json(['data' => $tag], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WinkTag $tag)
    {
        return response()->json(['data' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WinkTag $tag)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'slug' => ['sometimes', 'unique:wink_tags,slug,' . $tag->id . ',id', 'max:100']
        ]);
        $tag->update($data);
        return response()->json(['data' => $tag]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WinkTag $tag)
    {
        $tag->delete();
        return response()->noContent();
    }
}
