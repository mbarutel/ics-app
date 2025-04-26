<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Conferences</h1>

            @if ($isAdmin === 1)
                <a href="/create-conference"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-700 transition">
                    + Create Conference
                </a>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($conferences as $conference)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $conference->title }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-4 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $conference->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($conference->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/conference/{{ $conference->id }}/edit"
                                    class="text-blue-600 hover:text-blue-900 text-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $conferences->links() }}
        </div>
    </div>
</x-layout>
