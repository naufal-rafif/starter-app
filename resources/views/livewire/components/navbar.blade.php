<header class="fixed w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
    <nav class="container mx-auto px-4 py-4" x-data="{ isOpen: false }">
        <div class="flex justify-between items-center">
            <a href="{{ route('app.home') }}" wire:navigate class="text-2xl font-bold text-blue-600">NR</a>

            <!-- Mobile menu button -->
            <button class="md:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none" @click="isOpen = !isOpen"
                aria-label="Toggle menu">
                <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <div class="hidden {{count(request()->segments()) !== 0 ?: 'md:flex'}} space-x-8">
                <a href="#home" class="text-gray-600 hover:text-blue-600 transition">Home</a>
                <a href="#about" class="text-gray-600 hover:text-blue-600 transition">About</a>
                <a href="#projects" class="text-gray-600 hover:text-blue-600 transition">Projects</a>
                <a href="#blog" class="text-gray-600 hover:text-blue-600 transition">Blog</a>
                <a href="#contact" class="text-gray-600 hover:text-blue-600 transition">Contact</a>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden mt-4" @click.away="isOpen = false">
            <div class="flex flex-col space-y-4 bg-white px-4 py-6 rounded-lg shadow-lg">
                <a href="#home" @click="isOpen = false"
                    class="text-gray-600 hover:text-blue-600 transition block px-4 py-2 hover:bg-gray-50 rounded-lg">
                    Home
                </a>
                <a href="#about" @click="isOpen = false"
                    class="text-gray-600 hover:text-blue-600 transition block px-4 py-2 hover:bg-gray-50 rounded-lg">
                    About
                </a>
                <a href="#projects" @click="isOpen = false"
                    class="text-gray-600 hover:text-blue-600 transition block px-4 py-2 hover:bg-gray-50 rounded-lg">
                    Projects
                </a>
                <a href="#blog" @click="isOpen = false"
                    class="text-gray-600 hover:text-blue-600 transition block px-4 py-2 hover:bg-gray-50 rounded-lg">
                    Blog
                </a>
                <a href="#contact" @click="isOpen = false"
                    class="text-gray-600 hover:text-blue-600 transition block px-4 py-2 hover:bg-gray-50 rounded-lg">
                    Contact
                </a>
            </div>
        </div>
    </nav>
</header>