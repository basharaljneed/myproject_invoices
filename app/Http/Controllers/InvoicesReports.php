<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoicesReports extends Controller
{



    public function index()
    {
        // return 'my name is bashar aljneed';
        return view('reports.invoices_reports');
    }

    public function Search_invoices(Request $request)
    {


        // $invoices = invoices::all();
        // return $invoices;
        $rdio = $request->rdio;


        // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {


            // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                 $invoices = invoices::select('*')->where('status', '=', $request->type)->get();
             //  $invoices = invoices::all();

                $type = $request->type;
                return view('reports.invoices_reports', compact('type'))->withDetails($invoices);
            }

            // في حالة تحديد تاريخ استحقاق
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = invoices::whereBetween('invoice_Date', [$start_at, $end_at])->where('status', '=', $request->type)->get();
                return view('reports.invoices_reports', compact('type', 'start_at', 'end_at'))->withDetails($invoices);
            }
        }

        //====================================================================

        // في البحث برقم الفاتورة
        else {

            $invoices = invoices::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }
}
