<x-layout title="Customer Details">

    <div class="max-w-2xl mx-auto pt-6">
        <h1 class="text-3xl font-bold mb-6">Customer Details</h1>
  
        <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
            <div>
                <h2 class="text-lg font-semibold">CustomerId:</h2>
                <p>{{ $customer->id }}</p>
            </div>
  
            <div>
                <h2 class="text-lg font-semibold">Name:</h2>
                <p>{{ $customer->user->name }}</p>
            </div>
  
            <div>
                <h2 class="text-lg font-semibold">Email:</h2>
                <p>{{ $customer->user->email }}</p>
            </div>
  
            <div>
                <h2 class="text-lg font-semibold">Balance:</h2>
                <p>${{ number_format($customer->balance, 2) }}</p>
            </div>
  
            <div>
                <h2 class="text-lg font-semibold">Branch:</h2>
                <p>{{ $customer->branch->name ?? 'N/A' }}</p>
            </div>
  
            <div>
                <h2 class="text-lg font-semibold">Created At:</h2>
                <p>{{ $customer->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
  
            {{-- <a href="{{ route('employee.customers.index') }}" class="text-blue-600 hover:underline">← Back to list</a> --}}
        </div>
    </div>

    <div class="pb-10 flex gap-4 flex-wrap justify-center">

        <div class="bg-white shadow-md rounded-lg p-6 space-y-4 mt-8">
            <h2 class="text-xl font-bold">Transactions</h2>
        
            @forelse($customer->transactions as $transaction)
                <div class="border-b py-2">
                    <p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
                    <p><strong>Date:</strong> {{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            @empty
                <p class="text-gray-500">No transactions found.</p>
            @endforelse
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 space-y-4 mt-8">
            <h2 class="text-xl font-bold">Sent Transfers</h2>
        
            @forelse($customer->sentTransfers as $transfer)
                <div class="border-b py-2">
                    <p><strong>To:</strong> {{ $transfer->toCustomer->user->name ?? 'Unknown' }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($transfer->amount, 2) }}</p>
                    <p><strong>Date:</strong> {{ $transfer->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            @empty
                <p class="text-gray-500">No sent transfers found.</p>
            @endforelse
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 space-y-4 mt-8">
            <h2 class="text-xl font-bold">Received Transfers</h2>
        
            @forelse($customer->receivedTransfers as $transfer)
                <div class="border-b py-2">
                    <p><strong>From:</strong> {{ $transfer->fromCustomer->user->name ?? 'Unknown' }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($transfer->amount, 2) }}</p>
                    <p><strong>Date:</strong> {{ $transfer->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            @empty
                <p class="text-gray-500">No received transfers found.</p>
            @endforelse
        </div>

    </div>
    
  
</x-layout>
