<x-layout title="Create Branch">
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Create a New Branch</h1>

        <form action="{{ route('admin.branches.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4 max-w-xl">
            @csrf

            <!-- Branch Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Branch Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address') }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <!-- Submit Button -->
            <div>
                <button
                    type="submit"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                >
                    Create Branch
                </button>
            </div>
        </form>
    </div>
</x-layout>
