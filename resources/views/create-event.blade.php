<x-layout>

    <!-- Include Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="container mx-auto px-4 py-8">

        <form action="/event" method="POST"
            class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200" x-data="{
                description: @js(old('description', '')),
                editor: null,
                initQuill() {
                    this.editor = new Quill('#quill-editor', { theme: 'snow' });
            
                    // Set initial value if exists
                    this.editor.root.innerHTML = this.description;
            
                    // Update description when Quill content changes
                    this.editor.on('text-change', () => {
                        this.description = this.editor.root.innerHTML;
                    });
                }
            }"
            x-init="initQuill()">

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

            <!-- Description (Quill Rich Text Editor) -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Description</label>
                <div id="quill-editor" class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm p-3"></div>
                <input type="hidden" name="description" x-model="description">
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

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg">
                    Create Event
                </button>
            </div>

        </form>

    </div>

    <!-- Include Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

</x-layout>
