<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api',);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all invoices
        $invoices = Invoice::with('customer')->with('seller')->get();
        //response with json
        return response()->json($invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();

        //request date now
        $invoice->date = date('Y-m-d H:i:s');
        //seller 
        $invoice->seller_nit = auth()->user()->nit;
        $invoice->number = Invoice::latest()->first()->number + 1;
        //customer
        $invoice->customer_nit = $request->customer_nit;
        $invoice->total_with_iva = $request->total_with_iva;
        $invoice->total_without_iva = $request->total_without_iva;
        $invoice->iva = $request->iva;

        //Store a new invoice
        $invoice->save();

        //save invoice items
        $arrayInvoiceItems = [];
        foreach ($request->invoice_items as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_number = $invoice->number;
            $invoiceItem->description = $item['description'];
            $invoiceItem->quantity = $item['quantity'];
            $invoiceItem->item_id = $item['item_id'];
            $invoiceItem->price = $item['price'];
            $invoiceItem->total = $item['total'];
            $arrayInvoiceItems[] = $invoiceItem;
        }
        //save invoice items
        $invoice->invoiceItems()->saveMany($arrayInvoiceItems);

        //response with json
        return response()->json($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get invoice by id
        $invoice = Invoice::with('customer')->with('seller')->with('invoiceItems')->find($id);
        //response with json
        return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update invoice
        $invoice = Invoice::find($id);
        $invoice->update($request->all());
        //delete all invoice items
        $invoice->invoiceItems()->delete();
        //add new invoice items
        $arrayInvoiceItems = [];
        foreach ($request->invoice_items as $invoiceItem) {
            $invoiceNew = new InvoiceItem();
            $invoiceNew->invoice_number = $invoice->invoice_number;
            $invoiceNew->description = $invoiceItem['description'];
            $invoiceNew->quantity = $invoiceItem['quantity'];
            $invoiceNew->item_id = $invoiceItem['item_id'];
            $invoiceNew->price = $invoiceItem['price'];
            $invoiceNew->total = $invoiceItem['total'];
            $arrayInvoiceItems[] = $invoiceNew;
        }
        $invoice->invoiceItems()->saveMany($arrayInvoiceItems);

        $invoice = Invoice::with('customer')->with('seller')->with('invoiceItems')->find($id);
        //response with json
        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete invoice by id with invoiceItems
        $invoice = Invoice::find($id);
        $invoice->invoiceItems()->delete();
        $invoice->delete();
        //response with json
        return response()->json(['message' => 'Invoice deleted successfully'], 200);
    }
}
