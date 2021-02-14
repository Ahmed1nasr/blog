<div class="container mx-auto px-5 lg:max-w-screen mb-10 pb-5">
    <div class="lg:flex items-center lg:px-10">
        <div class="w-full lg:w-1/6 text-center lg:text-left lg:block hidden">
            <img src="{{ $author->avatar }}" class="rounded-full">
        </div>
        <div class="lg:pl-5 leading-loose text-text-color w-full lg:w-5/6">
            <div>
                <span class="font-bold">{{ $author->name }}</span>
                @if($bio = $author->bio)
                <div class="text-sm">
                    {!! $bio !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
