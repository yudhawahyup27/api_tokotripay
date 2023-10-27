<?php


// app/Http/Controllers/Api/TransactionController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function purchaseProduct(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|integer',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Proses pembelian produk dan dapatkan informasi dari Tripay API
        $product = Product::findOrFail($request->product_id);

        // Lakukan logika pembelian produk dan dapatkan data dari Tripay API

        // Simpan informasi pembelian ke dalam database
        $invoice = Invoice::create([
            'product_id' => $product->id,
            'tripay_reference' => $tripayResponse['reference'],
            'buyer_email' => $request->user()->email,  // Asumsi pengguna terautentikasi
            'buyer_phone' => $request->user()->phone,  // Asumsi pengguna terautentikasi
            'raw_response' => json_encode($tripayResponse),
            // Tambahkan kolom lain jika diperlukan
        ]);

        return response()->json($invoice, 201);
    }

    public function completePayment(Request $request)
    {
        // Validasi input
        $request->validate([
            'invoice_id' => 'required|integer',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Proses pembayaran dan dapatkan informasi dari Tripay API

        // Simpan informasi pembayaran ke dalam database
        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->update([
            // Update kolom pembayaran jika diperlukan
        ]);

        return response()->json($invoice, 200);
    }
}
