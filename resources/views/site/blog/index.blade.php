@extends('site.layouts.main')

@section('title' , 'Blog')

@section('content')
@if(request('by') && isset($author))
@include('site.partials.author' , ['author' => $author])
@endif

<div class="container mx-auto px-5 lg:max-w-lg mt-20" id="posts">
    @if($posts->total())
    @foreach ($posts as $post)
    @include('site.partials.posts.post' , ['post' => $post])
    @endforeach
    {{ $posts->withQueryString()->render() }}
    @else
    <p class="text-center font-bold uppercase">No Articles</p>
    @endif
</div>
@endsection
