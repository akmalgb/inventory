<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole('admin');

        //Customer
        $customerUser = User::create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => Hash::make('customer')
        ]);
        $customerUser->assignRole('customer');

        Customer::create([
            'user_id' => $customerUser->id,
            'name' => $customerUser->name,
        ]);

        //Supplier
        $supplierUser = User::create([
            'name' => 'Supplier',
            'email' => 'supplier@supplier.com',
            'password' => Hash::make('supplier')
        ]);
        $supplierUser->assignRole('supplier');

        Supplier::create([
            'user_id' => $supplierUser->id,
            'name' => $supplierUser->name,
            'slug' => 'supplier',
        ]);
    }
}
