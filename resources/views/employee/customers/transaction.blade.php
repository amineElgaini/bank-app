<x-layout title="Perform Transaction">

  <h1 class="text-2xl font-bold mb-6">Perform Transaction</h1>

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

  <form action="{{ route('employee.performTransaction') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4 max-w-xl">
      @csrf

      <!-- Customer -->
      <div>
          <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
          <select name="customer_id" id="customer_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
              <option value="">Select Customer</option>
              @foreach($customers as $customer)
                  <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->id }} - {{ $customer->user->name }}
                    </option>
              @endforeach
          </select>
      </div>

      <!-- Transaction Type -->
      <div>
          <label for="transaction_type" class="block text-sm font-medium text-gray-700">Transaction Type</label>
          <select name="transaction_type" id="transaction_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <option value="deposit" {{ old('transaction_type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
            <option value="withdrawal" {{ old('transaction_type') == 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
          </select>
      </div>

      <!-- Amount -->
      <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
          <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="0">
      </div>

      <!-- Submit Button -->
      <div>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
              Perform Transaction
          </button>
      </div>
  </form>

</x-layout>
