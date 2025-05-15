<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="#" class="text-xl font-bold text-blue-600">MyApp</a>
                @role('admin')
                    <a href="{{ route('admin.employees.index') }}" class="text-gray-700 hover:text-blue-600">Employees</a>
                    <a href="{{ route('admin.branches.index') }}" class="text-gray-700 hover:text-blue-600">Branches</a>
                @endrole
                @role('employee')
                    <a href="{{ route('employee.customers.index') }}" class="text-gray-700 hover:text-blue-600">Customers</a>
                @endrole
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-6 px-4">
        {{ $slot }}
    </main>

</body>
</html>
