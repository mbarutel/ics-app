<div x-data="{
    isChanged: false,
    formData: {
        title: @js($event->title),
        description: @js($event->description),
        start_date: @js($event->start_date),
        end_date: @js($event->end_date),
        venue: @js($event->venue)
    },
    originalData: @js($event->toArray())
}" x-init="console.log('Original Data:', originalData, 'Form Data:', formData)"
    x-effect="isChanged = ['title', 'description', 'start_date', 'end_date', 'venue'].some(key => formData[key] !== originalData[key])"
    class="container">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <form action="/event/{{ $event->id }}" method="POST">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Event</h2>

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" x-model="formData.title"
                    value="{{ old('title', $event->title) }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Rich Text Editor) -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="6" x-model="formData.description" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3 rich-text-editor">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date -->
            <div class="mb-6">
                <label for="start_date" class="block text-lg font-medium text-gray-700">Start Date & Time</label>
                <input type="datetime-local" id="start_date" name="start_date"
                    value="{{ old('start_date', isset($event) ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '') }}"
                    x-model="formData.start_date" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('start_date')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-6">
                <label for="end_date" class="block text-lg font-medium text-gray-700">End Date & Time</label>
                <input type="datetime-local" id="end_date" name="end_date"
                    value="{{ old('end_date', isset($event) ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}"
                    x-model="formData.end_date" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('end_date')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Venue -->
            <div class="mb-6">
                <label for="venue" class="block text-lg font-medium text-gray-700">Venue</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue', $event->venue) }}"
                    x-model="formData.venue" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('venue')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button x-bind:disabled="!isChanged" type="submit"
                class="mt-8 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg"
                :class="{ 'opacity-50 cursor-not-allowed': !isChanged }">
                Save Changes
            </button>
        </form>
        <form action="/event/{{ $event->id }}/publish" method="POST">
            @csrf
            <button type="submit"
                class="mt-8 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg">
                Publish Event
            </button>
        </form>
    </div>
</div>
