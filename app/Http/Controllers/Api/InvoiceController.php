<?php

// app/Http/Controllers/Api/InvoiceController.php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{ public function createTripayInvoice(Request $request)
    {
        // Validasi request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'required|numeric',
        ]);

        // Mendapatkan data produk dari database
        $product = Product::find($request->product_id);

        // Membuat invoice di database
        $invoice = Invoice::create([
            'product_id' => $product->id,
            'tripay_reference' => '', // Anda dapat mengisi ini dengan referensi Tripay
            'buyer_email' => $request->buyer_email,
            'buyer_phone' => $request->buyer_phone,
            'raw_response' => '', // Menyimpan raw response dari Tripay
        ]);

        // Membuat invoice di Tripay
        $tripayResponse = Http::post(config('tripay.base_url') . '/transaction/create', [
            'method' => 'QRIS',
            'merchant_ref' => $invoice->id,
            'amount' => $product->price,
            // Tambahkan parameter lain sesuai kebutuhan Tripay
        ], [
            'Authorization' => 'Bearer ' . config('tripay.api_key'),
        ]);

        // Mendapatkan response dari Tripay dan menyimpannya ke database
        $invoice->update(['raw_response' => $tripayResponse->body()]);

        return response()->json(['invoice' => $invoice, 'tripay_response' => $tripayResponse->json()]);
    }
}
