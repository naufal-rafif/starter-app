<div>
    @php
        $technologies = is_string($project->technologies)
            ? explode(',', $project->technologies)
            : ($project->technologies ?? []);
        $technical_details  = is_string($project->technical_details)
            ? explode(',', $project->technical_details)
            : ($project->technical_details ?? []);
    @endphp
    <!-- Project Content -->
    <main class="pt-24 pb-16">
        <!-- Project Hero -->
        <div class="container mx-auto px-4 mb-12">
            <div class="grid lg:grid-cols-2 gap-12">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        {{ $project->title }}
                    </h1>
                    <p class="text-xl text-gray-600 mb-6">
                        {{ $project->description }}
                    </p>
                    <div class="flex flex-wrap gap-3 mb-8">
                        @foreach($technologies as $tech)
                            <span class="px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div class="flex gap-4">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank"
                                class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                View Live Site
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:border-gray-400">
                                Source Code
                            </a>
                        @endif
                    </div>
                </div>
                <div>
                    @if($project->featured_image)
                        <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}"
                            class="rounded-xl shadow-lg w-full" />
                    @endif
                </div>
            </div>
        </div>

        <!-- Project Details -->
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Overview -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Project Overview</h2>
                <div class="text-gray-600">
                    {!! $project->content !!}
                </div>
            </section>

            <!-- Features -->
            @if($project->features && count($project->features) > 0)
                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Key Features</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($project->features as $feature)
                            <div class="p-6 bg-gray-50 rounded-xl">
                                <h3 class="text-xl font-semibold mb-3">{{ $feature['title'] }}</h3>
                                <p class="text-gray-600">
                                    {{ $feature['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Screenshots -->
            @if($project->screenshots && count($project->screenshots) > 0)
                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Screenshots</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($project->screenshots as $screenshot)
                            <img src="{{ Storage::url($screenshot) }}" alt="Screenshot" class="rounded-lg shadow-md" />
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Technical Details -->
            @if($technical_details && count($technical_details) > 0)
                <section class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Technical Details</h2>
                    <div class="prose max-w-none">
                        <ul>
                            @foreach($technical_details as $detail)
                                <li>{{ $detail }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            <!-- Next Project -->
            @if($nextProject)
                <section class="border-t border-gray-200 pt-12">
                    <h2 class="text-2xl font-bold mb-6">Next Project</h2>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($nextProject->featured_image)
                            <img src="{{ Storage::url($nextProject->featured_image) }}" alt="{{ $nextProject->title }}"
                                class="w-full" />
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">
                                {{ $nextProject->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                {{ $nextProject->description }}
                            </p>
                            <a href="{{ route('app.project.details', $nextProject->slug) }}"
                                class="text-indigo-600 hover:text-indigo-700">View Project →</a>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </main>
</div>