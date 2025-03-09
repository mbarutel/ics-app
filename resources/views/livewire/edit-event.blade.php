<!-- Include Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Alpine.js with Quill -->
<div x-data="{
    isChanged: false,
    isDraft: @js($event->status === 'draft'),
    formData: {
        title: @js($event->title),
        description: @js($event->description),
        start_date: @js($event->start_date),
        end_date: @js($event->end_date),
        venue: @js($event->venue)
    },
    originalData: @js($event->toArray()),
    editor: null,
    initQuill() {
        this.editor = new Quill('#quill-editor', {
            theme: 'snow'
        });

        // Set initial value
        this.editor.root.innerHTML = this.formData.description;

        // Update Alpine.js form data on change
        this.editor.on('text-change', () => {
            this.formData.description = this.editor.root.innerHTML;
        });
    }
}"
    x-effect="isChanged = ['title', 'description', 'start_date', 'end_date', 'venue'].some(key => {
        let formValue = key === 'description' ? (new DOMParser().parseFromString(formData[key], 'text/html').body.textContent.trim()) : formData[key];
        let originalValue = key === 'description' ? (new DOMParser().parseFromString(originalData[key], 'text/html').body.textContent.trim()) : originalData[key];

        return formValue !== originalValue;
    })"
    x-init="initQuill()" class="container">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Event</h2>

        <form action="/event/{{ $event->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" x-model="formData.title"
                    value="{{ old('title', $event->title) }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description with Quill -->
            <div>
                <label class="block text-lg font-medium text-gray-700">Description</label>
                <div id="quill-editor" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3"></div>
                <input type="hidden" name="description" x-model="formData.description">
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date -->
            <div>
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
            <div>
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
            <div>
                <label for="venue" class="block text-lg font-medium text-gray-700">Venue</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue', $event->venue) }}"
                    x-model="formData.venue" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('venue')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <button x-bind:disabled="!isChanged" type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg transition"
                :class="{ 'opacity-50 cursor-not-allowed': !isChanged }">
                Save Changes
            </button>
        </form>

        <!-- Publish Event Form -->
        <form x-bind:disabled="!isDraft && !isChanged" action="/event/{{ $event->id }}/publish" method="POST"
            class="mt-4 flex flex-col sm:flex-row sm:justify-end">
            @csrf
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg transition"
                :class="{ 'opacity-50 cursor-not-allowed': !isDraft }">
                Publish Event
            </button>
        </form>
    </div>
</div>

<!-- Include Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
