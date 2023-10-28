<?php

namespace App\Http\Controllers;

use App\Models\DealInvoice;
use Illuminate\Http\Request;

class DealInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "invoice";
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DealInvoice  $dealInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(DealInvoice $dealInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DealInvoice  $dealInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(DealInvoice $dealInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DealInvoice  $dealInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DealInvoice $dealInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DealInvoice  $dealInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealInvoice $dealInvoice)
    {
        //
    }
}
