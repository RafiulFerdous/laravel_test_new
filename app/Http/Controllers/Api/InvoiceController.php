<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceRepository;
    protected $productRepository;

    public function __construct(InvoiceRepository $invoiceRepository, ProductRepository $productRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->productRepository = $productRepository;
    }

    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'product_data' => 'required|array',
                'grand_total' => 'required|numeric',
                'pay' => 'required|numeric',
                'due' => 'required|numeric',
            ]);

            $invoiceNum = $this->generateRandomInvoiceNum();
            $productData = $data['product_data'];
            $grandTotal = $data['grand_total'];
            $pay = $data['pay'];
            $due = $data['due'];



            // Create the invoice
            $invoice = $this->invoiceRepository->create([
                'invoice_num' => $invoiceNum,
                'grand_total' => $grandTotal,
                'pay' => $pay,
                'due' => $due,
            ]);

            // Update products with the invoice ID
            $this->productRepository->updateProductsWithInvoice($invoice->id, $productData);

            return response()->json([
                'message' => 'Invoice created and products updated successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function generateRandomInvoiceNum()
    {

        return 'INV-' . mt_rand(1000, 9999);
    }
}
