<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionAndTransferController extends Controller
{

    public function transfer()
    {
        $employee = auth()->user()->employee;

        $customers = Customer::where('branch_id', $employee->branch_id)
        ->with('user')
        ->get();
        return view('employee.customers.transfer', compact('customers'));
    }

    public function transaction()
    {
        $employee = auth()->user()->employee;

        $customers = Customer::where('branch_id', $employee->branch_id)
        ->with('user')
        ->get();
        return view('employee.customers.transaction', compact('customers'));
    }

    public function performTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'sender_id' => 'required|exists:customers,id|different:receiver_id',
            'receiver_id' => 'required|exists:customers,id|different:sender_id',
        ]);
        

        $sender = Customer::findOrFail($request->sender_id);
        $receiver = Customer::findOrFail($request->receiver_id);
        $employee = auth()->user()->employee;

        if ($sender->branch_id !== $employee->branch_id) {
            return redirect()->back()->with('error', 'You are not authorized to perform transfers for this customer.')->withInput();
        }

        if ($sender->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance.')->withInput();
        }

        DB::transaction(function () use ($sender, $receiver, $request) {

            $sender->decrement('balance', $request->amount);

            $receiver->increment('balance', $request->amount);

            Transfer::create([
                'from_customer_id' => $sender->id,
                'to_customer_id' => $receiver->id,
                'amount' => $request->amount,
                'performed_by' => auth()->user()->employee->id,
                // 'description' => "Transfer from {$sender->user->name} to {$receiver->user->name}",
            ]);
        });

        return redirect()->route('employee.customers.index')->with('success', 'Transfer successful.')->withInput();
    }

    public function performTransaction(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|numeric|min:0.01',
            'amount' => 'required|numeric|min:0.01',
            'transaction_type' => 'required|in:deposit,withdrawal',
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $employee = auth()->user()->employee;

        if ($customer->branch_id !== $employee->branch_id) {
            return redirect()->back()->with('error', 'You are not authorized to perform transactions for this customer.')->withInput();
        }

        if ($request->transaction_type == 'withdrawal' && $customer->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance for withdrawal.')->withInput();
        }
        
        DB::transaction(function () use ($customer, $request) {

            if ($request->transaction_type == 'withdrawal') {
                $customer->decrement('balance', $request->amount);
            } else if ($request->transaction_type == 'deposit') {
                $customer->increment('balance', $request->amount);
            }

            Transaction::create([
                'customer_id' => $customer->id,
                // 'branch_id' => auth()->user()->employee->branch_id ,
                'transaction_type' => $request->transaction_type,
                'amount' => $request->amount,
                'performed_by' => auth()->user()->employee->id,
                'description' => ucfirst($request->transaction_type) . ' transaction',
            ]);
        });

        return redirect()->back()->with('success', 'Transaction successful.')->withInput();
    }
}
