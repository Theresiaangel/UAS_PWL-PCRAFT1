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