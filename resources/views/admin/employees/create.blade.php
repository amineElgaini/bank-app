<x-layout title="Add Employee">
  <div class="max-w-xl mx-auto py-8">
    
      <h2 class="text-xl font-bold mb-6 text-gray-800">Create Employee</h2>
      @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
          <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    
      @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('admin.employees.store') }}" method="POST">
          @csrf
          @include('admin.employees.form')
          <div class="mt-6">
              <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded transition"
              >
                Create
              </button>
          </div>
      </form>
  </div>
</x-layout>
