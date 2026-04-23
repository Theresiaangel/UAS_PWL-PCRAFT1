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
            'nama_customer'=> 'required',
            'email'=> 'required|email',
            'nomor_telepon'=>'required',
            'alamat' => 'required',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    public function update(Request $request, Customer $customer) {
        $customer->update($request->all());
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}