<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     return view('admin.dashboard', compact('users'));
    // }

    // public function show($id)
    // {
    //     $customer = Customer::with([
    //         'user',
    //         'branch',
    //         'transactions',
    //         'sentTransfers.toCustomer.user',
    //         'receivedTransfers.fromCustomer.user'
    //     ])->findOrFail($id);

    //     return view('employee.customers.show', compact('customer'));
    // }

}
