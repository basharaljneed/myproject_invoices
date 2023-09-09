<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetails;
use App\Models\Section;
use App\Models\User;
use App\Notifications\Add_NotifInvoices;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return '3690';
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sec = Section::all();
        return view('invoices.add_details', compact('sec'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dump($request);
        // return $request;

        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product_name,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        InvoicesDetails::create([
            'id_Invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product_name,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new InvoicesAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        $users = User::find(Auth::user()->id);
        $invoice_Det = Invoices::latest()->first();
        FacadesNotification::send($users, new Add_NotifInvoices($invoice_Det));
        
       





        session()->flash('Add', 'تمّ إضافة الفاتورة بنجاح');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($sd)
    {

        $invoices = invoices::findorfail($sd);
        return view('invoices.Status_updates', compact('invoices'));
    }




    public function showed($dt)
    {
        $sections = Section::all();
        $invoices = invoices::where('id', $dt)->first();
        return view('invoices.edite_invoices', compact('sections', 'invoices'));
        //return $invoices;
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sed, Request $request)
    {

        $invoices = invoices::findOrFail($sed);

        if ($request->Status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            InvoicesDetails::create([
                'id_Invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            InvoicesDetails::create([
                'id_Invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $invoices = invoices::find($request->invoice_id);
        //return $invoices;
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $invoices = invoices::findorfail($request->invoice_id);
        //return $request->id_page;
        if ($request->id_page == 2) {

            $invoices->delete();
            //$invoices->destroy();

            session()->flash('delete_invoice');

            return redirect('/invoices');
        } else {
            $invoices->forceDelete();

            session()->flash('forcedestroy');


            return redirect('/invoices');
        }
    }


    // public function forcedestroy(Request $request)
    // {
    //     $invoices = invoices::findorfail($request->invoice_id);
    //     $invoices->forceDelete();

    //     session()->flash('forcedestroy');
    //     return redirect('/invoices');
    // }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("product_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }

    public function invoices_paid()
    {
        $invoices = invoices::where('Value_Status', 1)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }

    public function invoices_unpaid()
    {
        $invoices = invoices::where('Value_Status', 2)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }

    public function invoices_partpaid()
    {
        $invoices = invoices::where('Value_Status', 3)->get();
        return view('invoices.invoices_partpaid', compact('invoices'));
    }

    public function invoices_archif()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_archif', compact('invoices'));
    }

    public function print_show($ps)
    {

        $invoices = invoices::where('id', $ps)->first();
        return view('invoices.print_invoices', compact('invoices'));
    }

    public function markread()
    {

        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return back();
    }
}
