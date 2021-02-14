<header class="py-5 mb-10">
    <div class="container mx-auto px-5 lg:max-w-screen">
        <div class="flex items-center">
            <a href="{{ route('index') }}" class="no-underline text-white text-2xl font-thin tracking-wide">{{ config('app.name') }}</a>

            <div class="ml-auto flex items-center">
                <a href="{{ route('index') }}"
                    class="text-white no-underline hover:underline text-xs font-bold uppercase">Home</a>
                <a href="{{ route('blog.tag.index') }}"
                    class="ml-5 text-white no-underline hover:underline text-xs font-bold uppercase">Tags</a>
            </div>
        </div>
    </div>
</header>
