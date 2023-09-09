<?php

namespace App\Http\Controllers;

use file;
use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use App\Models\Section;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoicesDetails $invoicesDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $request;
    }
    public function ddtt(Request $request)
    {
        $attch_delt = InvoicesAttachment::findorfail($request->id_file);
        //return $attch_delt;
        $attch_delt->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delet', 'تمّ الحذف بنجاح');
        return back();
      //  return $request;
    }












    public function showdet($nd)
    {
        Auth::user()->unreadNotifications->markAsRead();
        $invoice = invoices::where('id', $nd)->first();
        $invo_dets = InvoicesDetails::where('id_Invoices', $nd)->get();
        $invo_attchs = InvoicesAttachment::where('invoice_id', $nd)->get();

        //return $invo_attch;
        //return view('tabs');
        // return view('invoices.det');
        return view('invoices.detshow', compact('invoice', 'invo_dets', 'invo_attchs'));
    }
    public function View_file($invoice_number, $file_name)
    {

        $files = Storage::disk('public_uploads')->path($invoice_number . '/' . $file_name);
        // $files = Storage::path('public_uploads/'.$invoice_number . '/' . $file_name);

        return response()->file($files);
    }

    public function download($invoice_number, $file_name)
    {

         $files = Storage::disk('public_uploads')->path($invoice_number . '/' . $file_name);


        return response()->download($files);
    }

    public function delete_file(Request $request)
    {
         return $request->id_file;
       
    }
}
