<x-layout title="All Employees">
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">All Employees</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.employees.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                + Add Employee
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3">EmployeeId</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Branch</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 text-gray-700">{{ $employee->id }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $employee->user->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $employee->user->email }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $employee->branch->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                   class="inline-block text-blue-600 hover:underline font-medium">
                                    Edit
                                </a>

                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="inline-block text-red-600 hover:underline font-medium">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
