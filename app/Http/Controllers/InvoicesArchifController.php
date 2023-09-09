<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\InvoicesArchif;
use Illuminate\Http\Request;

class InvoicesArchifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->invoice_id;
        $final = invoices::where('id', $id)->withTrashed()->restore();
        session()->flash('restarchif');
        return redirect('/invoices_archif');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->invoice_id;
        $final = invoices::where('id', $id)->withTrashed()->first();
        $final->forceDelete();
        session()->flash('deltend');
        return redirect('/invoices_archif');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesArchif $invoicesArchif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoicesArchif $invoicesArchif)
    {
        //
    }
}
