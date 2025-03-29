<x-layout>

    <!-- Include Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="container mx-auto px-4 py-8">
        <form action="/conference" method="POST"
            class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200" x-data="{
                description: @js(old('description', '')),
                media_release: @js(old('media_release', '')),
                editorDescription: null,
                editorMediaRelease: null,
                initQuill() {
                    this.editorDescription = new Quill('#quill-editor-description', { theme: 'snow' });
                    this.editorDescription.root.innerHTML = this.description;
                    this.editorDescription.on('text-change', () => {
                        this.description = this.editorDescription.root.innerHTML;
                    });
            
                    this.editorMediaRelease = new Quill('#quill-editor-media-release', { theme: 'snow' });
                    this.editorMediaRelease.root.innerHTML = this.media_release;
                    this.editorMediaRelease.on('text-change', () => {
                        this.media_release = this.editorMediaRelease.root.innerHTML;
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
                <div id="quill-editor-description"
                    class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm p-3">
                </div>
                <input type="hidden" name="description" x-model="description">
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Media Release (Quill Rich Text Editor) -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Media Release</label>
                <div id="quill-editor-media-release"
                    class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm p-3">
                </div>
                <input type="hidden" name="media_release" x-model="media_release">
                @error('media_release')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Registration Prefix -->
            <div class="mb-6">
                <label for="registration_prefix" class="block text-lg font-medium text-gray-700">Registration
                    Prefix</label>
                <input type="text" id="registration_prefix" name="registration_prefix"
                    value="{{ old('registration_prefix') }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('registration_prefix')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg shadow-md text-lg">
                    Create Conference
                </button>
            </div>

        </form>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
</x-layout>
