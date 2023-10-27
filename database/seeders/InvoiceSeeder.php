<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::create([
            'product_id' => 1,
            'tripay_reference' => 'TRIPAY001',
            'buyer_email' => 'buyer@example.com',
            'buyer_phone' => '123456789',
            'raw_response' => 'Raw Response 1',
        ]);

        Invoice::create([
            'product_id' => 2,
            'tripay_reference' => 'TRIPAY002',
            'buyer_email' => 'another_buyer@example.com',
            'buyer_phone' => '987654321',
            'raw_response' => 'Raw Response 2',
        ]);
    }
}
