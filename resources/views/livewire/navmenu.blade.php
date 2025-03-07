<nav class="bg-white border-b border-gray-200 shadow-md" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="text-lg font-semibold text-gray-900">CRM App</a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                <a href="/events" class="text-gray-700 hover:text-blue-600">Events</a>
                <a href="/conferences" class="text-gray-700 hover:text-blue-600">Conferences</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Speakers</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Masterclass</a>

                <!-- Sign Out Button -->
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Sign Out
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button x-on:click="isOpen = !isOpen" class="text-gray-700 focus:outline-none focus:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div x-show="isOpen" class="md:hidden bg-white border-t border-gray-200 shadow-md">
        <div class="flex flex-col space-y-2 py-4 px-4">
            <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Events</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Conferences</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Speakers</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Masterclass</a>

            <!-- Mobile Sign Out Button -->
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="text-gray-700 hover:text-red-600 transition w-full text-left">
                    Sign Out
                </button>
            </form>
        </div>
    </div>
</nav>
