<div class="mt-10 mb-10 lg:flex items-center p-5 bg-light rounded">
    <div class="w-full lg:w-1/6 w-5 text-center lg:text-left">
        <a href="{{ route('blog.author.show' , $author) }}">
            <img src="{{ $author->avatar }}" class="rounded-full w-32 lg:w-full">
        </a>
    </div>
    <div class="lg:pl-5 leading-loose text-center lg:text-left text-text-color w-full lg:w-5/6">
        By <span class="font-bold">{{ $author->name }}</span>
        @if($bio = $author->bio)
        <div class="text-sm">
            {!! $bio !!}
        </div>
        @endif
    </div>
</div>
