<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\User;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Transfer;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $branch = Branch::create([
            'name' => "b1",
            'address' => "123 Main Street, city",
        ]);

        User::create([
            'name' => 'admin',
            // 'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => "admin",
            'password' => Hash::make('admin'),
        ]);

        $userAsEmployee = User::create([
            'name' => 'employee',
            // 'username' => 'employee',
            'email' => 'employee@gmail.com',
            'role' => "employee",
            'password' => Hash::make('employee'),
        ]);

        $userAsCustomer = User::create([
            'name' => 'customer',
            // 'username' => 'customer',
            'email' => 'customer@gmail.com',
            'role' => "customer",
            'password' => Hash::make('customer'),
        ]);


        $employee = Employee::create([
            'branch_id' => $branch->id,
            'salary' => 5000,
            'user_id' => $userAsEmployee->id
        ]);

        $customer = Customer::create([
            'user_id' => $userAsCustomer->id,
            'branch_id' => $branch->id,
            'balance' => 1000.00
        ]);

        Transaction::create([
            'customer_id' => $customer->id,
            'amount' => 50,
            'performed_by' => $employee->id,
            'type' => 'withdrawal'
        ]);

        Transaction::create([
            'customer_id' => $customer->id,
            'amount' => 50,
            'performed_by' => $employee->id,
            'type' => 'deposit'
        ]);

        Transfer::create([
            'from_customer_id' => $customer->id,
            'to_customer_id' => $customer->id, // same customer for demo purposes
            'amount' => 200,
            'performed_by' => $employee->id
        ]);
    }
}
