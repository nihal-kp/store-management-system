<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    
    public function updatePassword(Request $request, $customer_id)
    {
            $this->validate($request, [
                'current_password' => 'required',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ]);
            
        $customer = Customer::find($customer_id);
        
        if (!Hash::check($request->current_password, $customer->password)) {
            return response()->json(['errors' => ['current_password' => ['Current password does not match']]], 422);
        }
        
        $customer->password = Hash::make($request->password);
        $customer->save();
        
        return response()->json([
            'message' =>'Password Updated Successfully',
        ]);
    }
}
