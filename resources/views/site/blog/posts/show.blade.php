@extends('site.layouts.main')

@section('title' , $post->title)

@section('content')
<div class="container mx-auto px-5 lg:max-w-lg mt-20">
    <h1 class="mb-5 font-sans">{{ $post->title }}</h1>

    <p class="text-muted text-sm font-sans block">
        <span>
            @if($post->updated_at->gt($post->created_at))
            Updated: {{ $post->updated_at }}
            @else
            Created: {{ $post->created_at }}
            @endif
        </span>

        @if($post->tags->count())
        —
        @foreach ($post->tags as $tag)
        <a href="{{ route('blog.tag.show' , $tag) }}" class="text-muted">#{{ $tag->name }}</a>
        @endforeach
        @endif
        <a href="#disqus_thread"></a>
    </p>

    <div
        class="mt-20 mb-10 leading-loose text-base text-text-color flex flex-col justify-center items-center post-body">
        {!! $post->content !!}
    </div>

    {{-- @include('site.partials.posts.after_post') --}}
    @include('site.partials.posts.author' , ['author' => $post->author])

    <div class="comments">
        <div id="disqus_thread"></div>
    </div>
</div>
@endsection
@section('js')
<div id="disqus_thread"></div>
<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://blog-13.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<script id="dsq-count-scr" src="//blog-13.disqus.com/count.js" async></script>
@endsection
