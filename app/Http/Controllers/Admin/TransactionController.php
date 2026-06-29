<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::orderBy('date', 'desc')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create() {
        $transactions = Transaction::orderBy('date', 'desc')->get();
        return view('transactions.create', compact('transactions'));
    }

    public function store(Request $request) {
    // Pastikan nama di dalam validate sama dengan di form
    $request->validate([
        'date' => 'required',
        'product_description' => 'required',
        'unit_price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'nama_pembeli' => 'required'
    ]);

    $data = $request->all();
    
    $data['total'] = $request->unit_price * $request->quantity;
    $data['user_id'] = auth()->id();

    // Cek apakah customer ada
    $customer = \App\Models\Customer::where('customer_name', $request->nama_pembeli)->first();
    
    if (!$customer) {
        \App\Models\Customer::create([
            'customer_name' => $request->nama_pembeli,
            'email' => $request->email ?? '-',
            'phone_number' => $request->phone_number ?? '-',
            'address' => $request->address ?? '-',
            'user_id' => auth()->id()
        ]);
    } else {
        // Jika customer sudah ada dan form memberikan data baru (opsional update)
        if ($request->filled('email') || $request->filled('phone_number') || $request->filled('address')) {
            $customer->update([
                'email' => $request->email ?? $customer->email,
                'phone_number' => $request->phone_number ?? $customer->phone_number,
                'address' => $request->address ?? $customer->address,
                'user_id' => auth()->id()
            ]);
        }
    }

    // Simpan ke database
    Transaction::create($data);

    return redirect()->route('transactions.index');
}

    public function edit(Transaction $transaction) {
        $transactions = Transaction::orderBy('date', 'desc')->get();
        return view('transactions.edit', compact('transaction', 'transactions'));
    }

    public function update(Request $request, Transaction $transaction) {
    $request->validate([
        'date' => 'required|date',
        'product_description' => 'required',
        'unit_price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'nama_pembeli' => 'required'
    ]);

    $data = $request->all();
    
    // PERBAIKAN: Gunakan 'total' dan 'quantity' agar sinkron dengan database
    $data['total'] = $request->unit_price * $request->quantity;
    $data['user_id'] = auth()->id();

    $transaction->update($data);
    
    return redirect()->route('transactions.index');
}
    public function destroy(Transaction $transaction) {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}