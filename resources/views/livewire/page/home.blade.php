<div>

    <!-- Hero Section -->
    <section id="home" class="pt-24 lg:pt-32 pb-16 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 text-center md:text-start">
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Hello,
                    </h1>
                    <h2 class="text-2xl lg:text-4xl font-bold text-gray-700 mb-6">
                        I'm Naufal Rafif Danutirta
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Welcome to my page let`s talk about anything and make it happen
                    </p>
                    <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                        Get in Touch
                    </button>
                </div>
                <div class="lg:w-1/2">
                    <img src="https://picsum.photos/500" alt="Hero Image" class="rounded-lg shadow-xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">About Me</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="">
                    <img src="https://picsum.photos/500" alt="About Image"
                        class="rounded-lg shadow-lg w-full bg-cover" />
                </div>
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Hi, I'm Lorem Ipsum</h3>
                    <p class="text-gray-600 mb-6">
                        With over 5 years of experience in web development, I specialize in creating
                        beautiful and functional websites that help businesses grow their online presence.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold mb-2">Frontend Development</h4>
                            <p class="text-gray-600">HTML, CSS, JavaScript</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold mb-2">Backend Development</h4>
                            <p class="text-gray-600">PHP, Laravel, MySQL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Featured Projects</h2>
            <div class="flex flex-wrap justify-center">
                @foreach ($projects as $project)
                    <div class="p-4 w-full sm:w-1/2 md:w-1/3 xl:w-1/4">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->slug }} image"
                                class="w-full" />
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4">
                                    {{ $project->description }}
                                </p>
                                <a href="{{ route('app.project.details', $project->slug) }}" wire:navigate
                                    class="text-blue-600 hover:text-blue-700">View Project →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Latest Blog Posts</h2>
            <div class="flex flex-wrap justify-center">
                @foreach ($blogs as $blog)
                    <!-- Blog Post Card -->
                    <div class="p-4 w-full sm:w-1/2 md:w-1/3 xl:w-1/4 flex">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full w-full">
                            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }} image"
                                class="w-full" />
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-sm text-gray-500 mb-2">{{ $blog->published_at->format('Y-m-d') }}</div>
                                <h3 class="text-xl font-semibold mb-2">
                                    {{ $blog->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">
                                    {!! $blog->content !!}
                                </p>
                                <a href="{{ route('app.blog.details', $blog->slug) }}" wire:navigate
                                    class="text-blue-600 hover:text-blue-700 mt-auto">Read More →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
