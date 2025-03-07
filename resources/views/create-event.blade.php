<x-layout>

    <div class="container mx-auto px-4 py-8">

        <form action="/event" method="POST"
            class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            @csrf

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create Event</h2>

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Rich Text Editor) -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="6" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3 rich-text-editor">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-6">
                <label for="start_date" class="block text-lg font-medium text-gray-700">Start Date & Time</label>
                <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('start_date')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-6">
                <label for="end_date" class="block text-lg font-medium text-gray-700">End Date & Time</label>
                <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('end_date')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Venue -->
            <div class="mb-6">
                <label for="venue" class="block text-lg font-medium text-gray-700">Venue</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue') }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('venue')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Toggle -->
            <div class="mb-6 flex items-center">
                <label for="status" class="block text-lg font-medium text-gray-700 mr-4">Status</label>
                <input type="hidden" name="status" value="inactive">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="status" name="status" value="active"
                        {{ old('status') === 'active' ? 'checked' : '' }} class="sr-only peer">
                    <div
                        class="w-12 h-6 bg-gray-300 peer-focus:ring-2 peer-focus:ring-indigo-500 rounded-full peer peer-checked:bg-indigo-600">
                    </div>
                    <span class="ml-3 text-gray-700 text-lg font-medium peer-checked:text-indigo-600">
                        Active
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg">
                    Create Event
                </button>
            </div>
        </form>

    </div>

</x-layout>
