<nav class="bg-white border-b border-gray-200 shadow-md" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="#" class="text-lg font-semibold text-gray-900">CRM App</a>
            </div>
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Events</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Conferences</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Speakers</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Masterclass</a>
            </div>
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
    <div x-show="isOpen" class="md:hidden bg-white border-t border-gray-200 shadow-md">
        <div class="flex flex-col space-y-2 py-4 px-4">
            <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Events</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Conferences</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Speakers</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Masterclass</a>
        </div>
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button>Sign Out</button>
    </form>
</nav>
