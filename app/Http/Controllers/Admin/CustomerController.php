<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    public function create()
    {
        $customers = Customer::all();

        return view('customers.create', compact('customers'));
    }

    public function edit (Customer $customer) {
        $customers = Customer::all();

        return view('customers.edit', compact('customer','customers'));
    }
    public function store(Request $request) 
    {
        $request->validate([
            'customer_name'=> 'required',
            'email'=> 'required|email',
            'phone_number'=>'required',
            'address' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Customer::create($data);
        return redirect()->route('customers.index');
    }

    public function update(Request $request, Customer $customer) {
        $request->validate([
            'customer_name'=> 'required',
            'email'=> 'required|email',
            'phone_number'=>'required',
            'address' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        $customer->update($data);
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}