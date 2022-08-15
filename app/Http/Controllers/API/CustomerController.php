<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserCustomerRequest;
use App\Http\Requests\UpdateUserCustomerRequest;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index() {
        $customers = CustomerResource::collection(Customer::all());
        return response()->json($customers, 200);
    }

    public function show($id) {
        $customer = new CustomerResource(Customer::find($id));
        return response()->json($customer);
    }

    public function store(StoreUserCustomerRequest $request) {
        $data = $request->validated();
        $customerUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $customerUser->assignRole('customer');
        $customer = Customer::create([
            'user_id' => $customerUser->id,
            'name' => $data['name'],
        ]);

        return response()->json([
            'user_data' => new UserResource($customerUser),
            'customer_data' => new CustomerResource($customer),
        ]);
    }

    public function update(UpdateUserCustomerRequest $request, $id) {
        $data = $request->validated();
        $customer = Customer::find($id);

        $customer->name = $data['name'];
        $customer->User->name = $data['name'];
        $customer->User->email = $data['email'];
        $customer->User->password = bcrypt($data['password']);

        $customer->save();

        return response()->json($customer);
    }

    public function destroy($id) {
        $customer = Customer::find($id);
        $user = $customer->User;

        $customer->delete();
        $user->delete();

        return response()->json($customer);
    }
}
