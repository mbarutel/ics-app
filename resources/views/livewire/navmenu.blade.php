<div x-data="{ isOpen: false }">
    <button x-on:click="isOpen = !isOpen" class="bg-blue-200 rounded-sm m-2 px-2 py-1 cursor-pointer active:scale-95">
        NavBar
    </button>

    <div x-show="isOpen" class="absolute top-full left-0 flex flex-col bg-stone-700 text-white">
        <a class="hover:bg-white hover:text-stone-700 p-5" href="#">Dashboard</a>
        <a class="hover:bg-white hover:text-stone-700 p-5" href="#">Events</a>
        <a class="hover:bg-white hover:text-stone-700 p-5" href="#">Conferences</a>
        <a class="hover:bg-white hover:text-stone-700 p-5" href="#">Speakers</a>
        <a class="hover:bg-white hover:text-stone-700 p-5" href="#">Masterclass</a>
    </div>
</div>
