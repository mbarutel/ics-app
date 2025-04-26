<!-- Include Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Alpine.js with Quill -->
<div x-data="{
    isChanged: false,
    isDraft: @js($conference->status === 'draft'),
    formData: {
        title: @js($conference->title),
        description: @js($conference->description),
        media_release: @js($conference->media_release),
        registration_prefix: @js($conference->registration_prefix),
    },
    originalData: @js($conference->toArray()),
    editors: {
        description: null,
        media_release: null,
    },
    initQuill() {
        // Initialize description editor
        this.editors.description = new Quill('#quill-editor-description', {
            theme: 'snow'
        });

        this.editors.description.root.innerHTML = this.formData.description;
        this.editors.description.on('text-change', () => {
            this.formData.description = this.editors.description.root.innerHTML;
        });

        // Initialize media_release editor
        this.editors.media_release = new Quill('#quill-editor-media-release', {
            theme: 'snow'
        });
        this.editors.media_release.root.innerHTML = this.formData.media_release;
        this.editors.media_release.on('text-change', () => {
            this.formData.media_release = this.editors.media_release.root.innerHTML;
        });
    }
}"
    x-effect="isChanged = ['title', 'description', 'media_release', 'registration_prefix'].some(key => {
        let formValue = key === 'description' ? (new DOMParser().parseFromString(formData[key], 'text/html').body.textContent.trim()) : formData[key];
        let originalValue = key === 'description' ? (new DOMParser().parseFromString(originalData[key], 'text/html').body.textContent.trim()) : originalData[key];

        return formValue !== originalValue;
    })"
    x-init="initQuill()" class="container">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Conference</h2>

        <form action="/conference/{{ $conference->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" x-model="formData.title"
                    value="{{ old('title', $conference->title) }}" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('title')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description with Quill -->
            <div>
                <label class="block text-lg font-medium text-gray-700">Description</label>
                <div id="quill-editor-description" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3">
                </div>
                <input type="hidden" name="description" x-model="formData.description">
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Media Release with Quill -->
            <div>
                <label class="block text-lg font-medium text-gray-700">Media Release</label>
                <div id="quill-editor-media-release" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3">
                </div>
                <input type="hidden" name="media_release" x-model="formData.media_release">
                @error('media_release')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Registration Prefix -->
            <div>
                <label for="venue" class="block text-lg font-medium text-gray-700">Registration Prefix</label>
                <input type="text" id="registration_prefix" name="registration_prefix"
                    value="{{ old('registration_prefix', $conference->registration_prefix) }}"
                    x-model="formData.registration_prefix" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 p-3">
                @error('registration_prefix')
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
        <form x-bind:disabled="!isDraft && !isChanged" action="/conference/{{ $conference->id }}/publish" method="POST"
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
