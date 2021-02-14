@extends('site.layouts.main')

@section('title' , $tag->name)

@section('content')
<div class="container mx-auto px-5 lg:max-w-screen mb-20">
    <h2 class="text-center text-white">
        Articles on {{ $tag->name }}
    </h2>
    {{-- <p class="text-center text-muted mt-5 leading-normal">
        If you want to get notified whenever new content is available, consider
        <a href="http://eepurl.com/cR8hh9">joining the mailing list</a>.
    </p> --}}
</div>
<div class="container mx-auto px-5 lg:max-w-screen">
    @if($tag->posts->count())
    @foreach ($tag->posts as $post)
    @include('site.partials.posts.post' , ['post' => $post])
    @endforeach
    @else
    <p class="text-center font-bold uppercase">No Articles</p>
    @endif
</div>
@endsection
