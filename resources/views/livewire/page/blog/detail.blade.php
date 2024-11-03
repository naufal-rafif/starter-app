<div>
    <main class="pt-24 pb-16">
        @if (auth()->user() && $blog->published_at >= now())
            <div class="bg-yellow-500 text-white">
                <div class="mx-auto container px-4 mb-8 text-center py-4">
                    Preview Mode - This is how your blog post will look when published
                </div>
            </div>
        @endif
        <!-- Featured Image -->
        <div class="container mx-auto px-4 mb-8">
            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}"
                class="w-full h-[400px] object-cover rounded-xl shadow-lg" />
        </div>

        <!-- Article Content -->
        <article class="container mx-auto px-4 max-w-4xl">
            <!-- Article Header -->
            <header class="mb-8">
                <div class="flex items-center gap-4 text-gray-600 mb-4">
                    <time datetime="{{ $blog->published_at->format('Y-m-d') }}">
                        {{ $blog->published_at->format('F d, Y') }}
                    </time>
                    <span>•</span>
                    <span>{{ $blog->reading_time }} min read</span>
                    <span>•</span>
                    <span>{{ $blog->category->name }}</span>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    {{ $blog->title }}
                </h1>
                <div class="flex items-center gap-4">
                    <img src="{{ $blog->author->profile_photo_url ?: 'https://placehold.co/40' }}" alt="{{ $blog->author->name }}"
                        class="w-10 h-10 rounded-full" />
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $blog->author->name }}</h3>
                        <p class="text-gray-600">{{ $blog->author->title }}</p>
                    </div>
                </div>
            </header>

            <!-- Article Body -->
            <div class="prose prose-lg max-w-none">
                {!! $blog->content !!}
            </div>

            <!-- Share Buttons -->
            <div class="border-t border-gray-200 mt-12 pt-8">
                <h3 class="text-lg font-semibold mb-4">Share this article</h3>
                <div class="flex gap-4">
                    <button wire:click="share('twitter')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Share on Twitter
                    </button>
                    <button wire:click="share('linkedin')"
                        class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900">
                        Share on LinkedIn
                    </button>
                </div>
            </div>

            <!-- Related Posts -->
            <div class="border-t border-gray-200 mt-12 pt-12">
                <h3 class="text-2xl font-bold mb-8">Related Articles</h3>
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach($relatedPosts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                class="w-full h-56 object-cover" />
                            <div class="p-6">
                                <h4 class="text-xl font-semibold mb-2">
                                    {{ $post->title }}
                                </h4>
                                <p class="text-gray-600 mb-4">
                                    {{ $post->excerpt }}
                                </p>
                                <a href="{{ route('app.blog.details', $post) }}"
                                    class="text-indigo-600 hover:text-indigo-700">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>
    </main>
</div>