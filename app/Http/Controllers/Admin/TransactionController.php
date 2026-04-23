<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::orderBy('tanggal', 'desc')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create() {
        $transactions = Transaction::orderBy('tanggal', 'desc')->get();
        return view('transactions.create', compact('transactions'));
    }

    public function store(Request $request) {
    // Pastikan nama di dalam validate sama dengan di form
    $request->validate([
        'tanggal' => 'required',
        'keterangan_produk' => 'required',
        'harga_satuan' => 'required|numeric',
        'jumlah_barang' => 'required|numeric',
    ]);

    $data = $request->all();
    
    $data['total'] = $request->harga_satuan * $request->jumlah_barang;

    // Simpan ke database
    Transaction::create($data);

    return redirect()->route('transactions.index');
}

    public function edit(Transaction $transaction) {
        $transactions = Transaction::orderBy('tanggal', 'desc')->get();
        return view('transactions.edit', compact('transaction', 'transactions'));
    }

    public function update(Request $request, Transaction $transaction) {
    $request->validate([
        'tanggal' => 'required|date',
        'keterangan_produk' => 'required',
        'harga_satuan' => 'required|numeric',
        'jumlah_barang' => 'required|numeric', // Ganti dari 'jumlah'
    ]);

    $data = $request->all();
    
    // PERBAIKAN: Gunakan 'total' dan 'jumlah_barang' agar sinkron dengan database
    $data['total'] = $request->harga_satuan * $request->jumlah_barang;

    $transaction->update($data);
    
    return redirect()->route('transactions.index');
}
    public function destroy(Transaction $transaction) {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}