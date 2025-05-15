<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;
        $customers = Customer::with('user')
        ->where('branch_id', $employee->branch_id)
        ->whereNull('deleted_at')
        ->get();
        return view('employee.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with([
            'user',
            'branch',
            'transactions',
            'sentTransfers.toCustomer.user',
            'receivedTransfers.fromCustomer.user'
        ])->findOrFail($id);
        return view('employee.customers.show', compact('customer'));
    }

    public function create()
    {
        return view('employee.customers.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        // 'phone' => 'required|string|max:15',
        // 'address' => 'required|string|max:255',
    ]);

    DB::transaction(function () use ($validated) {
        $employee = Auth::user()->employee;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);
        
        Customer::create([
            'user_id' => $user->id,
            // 'phone' => $validated['phone'],
            // 'address' => $validated['address'],
            'branch_id' => $employee->branch_id,
        ]);
    });

    return redirect()->back()->with('success', 'User and Customer created successfully.');
}

    public function edit($id)
{
    $customer = Customer::findOrFail($id);
    $user = $customer->user;
    return view('employee.customers.edit', compact('customer', 'user'));
}

public function update(Request $request,Customer $customer)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $customer->user->id,
    ]);
    
    DB::transaction(function () use ($request, $customer) {
        
        $user = $customer->user;
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        $customer->update([
            // 'phone' => $request->phone,
            // 'address' => $request->address,
        ]);
    });

    return redirect()->route('employee.customers.index')->with('success', 'Customer updated successfully.');
}


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('employee.customers.index')->with('success', 'Customer deleted successfully.');
    }

}
