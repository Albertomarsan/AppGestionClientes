<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Hobbie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class ProfileController extends Controller
{
    public function edit(Customer $customer){
        $hobbies = Hobbie::all();
        $customerHobbies = array_column($customer->hobbies->toArray(), 'id');
        return view('profile.edit', compact('hobbies', 'customerHobbies', 'customer'));
    }

    public function update(Customer $customer, CustomerUpdateRequest $request){
        if(Auth::user()->customer->id == $customer->id){
            $data = $request->all();
            DB::transaction(function () use($customer, $data) {
                $customer->update([
                    'name' => $data['name'],
                    'surname' => $data['surname']
                ]);

                $customer->hobbies()->sync(isset($data['hobbies']) ? $data['hobbies'] : []);
            });

            return redirect('/customers');
        }else{
            return redirect('/home');
        }
        
    }
}
