<x-layout title="Customers List">
  <div class="max-w-4xl mx-auto py-8">
      <h1 class="text-2xl font-bold mb-6">All Customers</h1>

      @if(session('success'))
          <div class="mb-4 text-green-600">{{ session('success') }}</div>
      @endif


      <div class="mb-4 flex space-x-4">
        <a href="{{ route('employee.customers.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            Create New Customer
        </a>
      
        <a href="{{ route('employee.transfer') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
            Transfer Money
        </a>
    
        <!-- Transaction Button -->
        <a href="{{ route('employee.transaction') }}" class="inline-block bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition">
            Perform Transaction
        </a>
       </div>

      <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-gray-200">
              <tr>
                  <th class="px-4 py-2 text-left">id</th>
                  <th class="px-4 py-2 text-left">Name</th>
                  <th class="px-4 py-2 text-left">Email</th>
                  <th class="px-4 py-2 text-left">Balance</th>
                  <th class="px-4 py-2">Actions</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($customers as $customer)
                  <tr class="border-b">
                      <td class="px-4 py-2">{{ $customer->id }}</td>
                      <td class="px-4 py-2">{{ $customer->user->name }}</td>
                      <td class="px-4 py-2">{{ $customer->user->email }}</td>
                      <td class="px-4 py-2">{{ $customer->balance }}</td>
                      <td class="px-4 py-2 flex space-x-2">
                          <!-- Show Button -->
                          <a href="{{ route('employee.customers.show', $customer->id) }}" class="text-green-600 hover:underline">Show</a>

                          <!-- Edit Button -->
                          <a href="{{ route('employee.customers.edit', $customer->id) }}" class="text-blue-600 hover:underline">Edit</a>

                          <!-- Delete Button -->
                          <form action="{{ route('employee.customers.destroy', $customer->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</x-layout>
