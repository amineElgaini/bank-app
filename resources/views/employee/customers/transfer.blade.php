<x-layout title="Transfer Money">

  <h1 class="text-2xl font-bold mb-6">Transfer Money</h1>

  @if(session('success'))
      <div class="mb-4 text-green-600">{{ session('success') }}</div>
  @endif

  
  @if(session('error'))
    <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

  @if($errors->any())
      <div class="mb-4 text-red-600">
          @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
          @endforeach
      </div>
  @endif

  <form action="{{ route('employee.performTransfer') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4 max-w-xl">
      @csrf
    @method('POST')
      <!-- Sender -->
      <div>
          <label for="sender_id" class="block text-sm font-medium text-gray-700">Sender</label>
          <select name="sender_id" id="sender_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              <option value="">Select Sender</option>
              @foreach($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->user->name }}</option>
              @endforeach
          </select>
      </div>

      <!-- Receiver -->
      <div>
          <label for="receiver_id" class="block text-sm font-medium text-gray-700">Receiver</label>
          <select name="receiver_id" id="receiver_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              <option value="">Select Receiver</option>
              @foreach($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->user->name }}</option>
              @endforeach
          </select>
      </div>

      <!-- Amount -->
      <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" name="amount" id="amount" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="0">
      </div>

      <!-- Submit Button -->
      <div>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
              Transfer Money
          </button>
      </div>
  </form>

</x-layout>
