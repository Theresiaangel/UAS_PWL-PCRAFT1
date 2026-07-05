<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $sort = $request->query('sort', 'terbaru');
        $order = $sort === 'terlama' ? 'asc' : 'desc';

        $transactions = Transaction::orderBy('date', $order)->orderBy('id', $order)->paginate(10)->appends(['sort' => $sort]);
        return view('transactions.index', compact('transactions', 'sort'));
    }

    public function create() {
        $transactions = Transaction::orderBy('date', 'desc')->paginate(10);
        return view('transactions.create', compact('transactions'));
    }

    public function store(Request $request) {
    // Pastikan nama di dalam validate sama dengan di form
    $request->validate([
        'date' => 'required',
        'product_description' => 'required',
        'unit_price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'customer_name' => 'required'
    ]);

    $data = $request->all();
    
    $data['total'] = $request->unit_price * $request->quantity;
    $data['user_id'] = auth()->id();

    // Cek apakah customer ada
    $customer = \App\Models\Customer::where('customer_name', $request->customer_name)->first();
    
    if (!$customer) {
        $customer = \App\Models\Customer::create([
            'customer_name' => $request->customer_name,
            'email' => $request->filled('email') ? $request->email : null,
            'phone_number' => $request->filled('phone_number') ? $request->phone_number : null,
            'address' => $request->filled('address') ? $request->address : null,
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

    $data['customer_id'] = $customer->id;

    // Simpan ke database
    Transaction::create($data);

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
}

    public function edit(Transaction $transaction) {
        $transactions = Transaction::orderBy('date', 'desc')->paginate(10);
        return view('transactions.edit', compact('transaction', 'transactions'));
    }

    public function update(Request $request, Transaction $transaction) {
    $request->validate([
        'date' => 'required|date',
        'product_description' => 'required',
        'unit_price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'customer_name' => 'required'
    ]);

    $data = $request->all();
    
    // PERBAIKAN: Gunakan 'total' dan 'quantity' agar sinkron dengan database
    $data['total'] = $request->unit_price * $request->quantity;
    $data['user_id'] = auth()->id();

    // Cari customer berdasarkan relasi ID atau dari nama sebelumnya
    $customer = $transaction->customer ?? \App\Models\Customer::where('customer_name', $transaction->customer_name)->first();
    
    if ($customer) {
        $oldName = $customer->customer_name;
        $newName = $request->customer_name;

        // Cek apakah nama baru sudah dipakai customer lain
        $existingOtherCustomer = \App\Models\Customer::where('customer_name', $newName)
                                                     ->where('id', '!=', $customer->id)
                                                     ->first();

        if ($existingOtherCustomer) {
            // Jika nama baru sudah ada di database, cukup tautkan transaksi ini ke customer tersebut
            $customer = $existingOtherCustomer;
            $data['customer_id'] = $customer->id;
        } else {
            // Jika nama baru belum ada, update data customer lama
            $customer->update([
                'customer_name' => $newName,
                'email' => $request->filled('email') ? $request->email : $customer->email,
                'phone_number' => $request->filled('phone_number') ? $request->phone_number : $customer->phone_number,
                'address' => $request->filled('address') ? $request->address : $customer->address,
            ]);

            // Sinkronkan nama di semua transaksi lamanya
            if ($oldName !== $newName) {
                \App\Models\Transaction::where('customer_name', $oldName)
                    ->update(['customer_name' => $newName, 'customer_id' => $customer->id]);
            }
            $data['customer_id'] = $customer->id;
        }
    } else {
        // Fallback jika tidak ditemukan sama sekali
        $customer = \App\Models\Customer::create([
            'customer_name' => $request->customer_name,
            'email' => $request->filled('email') ? $request->email : null,
            'phone_number' => $request->filled('phone_number') ? $request->phone_number : null,
            'address' => $request->filled('address') ? $request->address : null,
            'user_id' => auth()->id()
        ]);
        $data['customer_id'] = $customer->id;
    }

    $transaction->update($data);
    
    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
}
    public function destroy(Transaction $transaction) {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}