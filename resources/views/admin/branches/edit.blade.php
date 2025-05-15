<x-layout title="{{ isset($branch) ? 'Edit Branch' : 'Create Branch' }}">
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            {{ isset($branch) ? 'Edit Branch' : 'Create a New Branch' }}
        </h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($branch) ? route('admin.branches.update', $branch->id) : route('admin.branches.store') }}"
            method="POST"
            class="bg-white p-6 rounded-lg shadow-md space-y-6"
        >
            @csrf
            @if(isset($branch))
                @method('PUT')
            @endif

            <!-- Branch Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Branch Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $branch->name ?? '') }}"
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
                    value="{{ old('address', $branch->address ?? '') }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <!-- Submit Button -->
            <div>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition"
                >
                    {{ isset($branch) ? 'Update Branch' : 'Create Branch' }}
                </button>
            </div>
        </form>
    </div>
</x-layout>
