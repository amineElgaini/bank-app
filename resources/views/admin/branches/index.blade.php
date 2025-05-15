<x-layout title="All Branches">
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">All Branches</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('admin.branches.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Create New Branch
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Address</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    @foreach ($branches as $branch)
                        <tr>
                            <td class="px-6 py-4">{{ $branch->id }}</td>
                            <td class="px-6 py-4">{{ $branch->name }}</td>
                            <td class="px-6 py-4">{{ $branch->address }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.branches.edit', $branch->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
