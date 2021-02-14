@extends('site.layouts.main')

@section('title' , 'Tags')

@section('content')
{{-- <div class="container mx-auto px-5 lg:max-w-screen mb-20">
    <h2 class="text-center text-white">
        Check the list of topics we discussed here on Diving Laravel.
    </h2>
    <p class="text-center text-muted mt-5 leading-normal">
        We're trying to cover as many topics in our articles. However, if you have ideas for specific topics that we
        should cover please
        <a href="https://twitter.com/themsaid">let me know</a>. I want to know what you wish to learn about :)
    </p>
</div> --}}
<div class="container mx-auto px-5 lg:max-w-screen flex flex-wrap mb-20">
    @foreach ($tags as $tag)
    <a class="no-underline transition block flex-auto mx-2 w-full lg:w-1/4" href="{{ route('blog.tag.show' , $tag) }}">
        <div class="mb-5 p-5 bg-light rounded">
            {{ $tag->name }}
        </div>
    </a>
    @endforeach
</div>
@endsection
