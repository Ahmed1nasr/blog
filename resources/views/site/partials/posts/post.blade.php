<a class="no-underline transition block topic" href="{{ route('blog.post.show' , $post) }}" data-post-created-at="{{ $post->created_at }}">
    <div class="w-full mb-10 p-5 bg-white rounded single_post">
        <p class="text-muted font-sans text-xs mb-2">
            <span>
                @if($post->updated_at->gt($post->created_at))
                Updated: {{ $post->updated_at }}
                @else
                Created: {{ $post->created_at }}
                @endif
            </span>
            @if($tags = $post->tags)
            —
            @foreach ($tags as $tag)
            #{{ $tag->name }}
            @endforeach
            @endif
            @if($author = $post->author)
            —
            by : {{ $author->name }}
            @endif
        </p>

        @if($title = $post->title)
        <h2 class="leading-normal block">
            {{ $title }}
        </h2>
        @endif

        @if($excerpt = $post->excerpt)
        <p class="leading-normal mt-1 text-muted">
            {{ $excerpt }}
        </p>
        @endif
    </div>
</a>
