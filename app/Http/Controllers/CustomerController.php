<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Hobbie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customer.customers-list', compact('customers'));
    }

    public function create(){
        $hobbies = Hobbie::all();
        return view('customer.customers-form', compact('hobbies'));
    }

    public function edit(Customer $customer){
        $hobbies = Hobbie::all();
        $customerHobbies = array_column($customer->hobbies->toArray(), 'id');
        return view('customer.customers-form', compact('hobbies', 'customerHobbies', 'customer'));
    }

    public function update(Customer $customer, CustomerUpdateRequest $request){
        $data = $request->all();
        DB::transaction(function () use($customer, $data) {
            $customer->update([
                'name' => $data['name'],
                'surname' => $data['surname']
            ]);

            $customer->hobbies()->sync(isset($data['hobbies']) ? $data['hobbies'] : []);
        });

        return redirect('/customers');
    }

    public function store(CustomerStoreRequest $request){
        $data = $request->all();
        DB::transaction(function () use($data) {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'profile_id' => 2
            ]);
            $customer = Customer::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'user_id' => $user->refresh()->id
            ]);
            $customer->hobbies()->sync(isset($data['hobbies']) ? $data['hobbies'] : []);
        });
        
        return redirect('/customers');
    }

    public function delete(Customer $customer){
        $customer->delete();
        return response()->json([
            'status' => 'ok'
        ]);
    }
    
}
