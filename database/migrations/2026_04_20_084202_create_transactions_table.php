<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal'); 
        $table->string('keterangan_produk'); 
        $table->decimal('harga_satuan', 15, 2); 
        $table->integer('jumlah_barang');  
        $table->decimal('total', 15, 2);      
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};