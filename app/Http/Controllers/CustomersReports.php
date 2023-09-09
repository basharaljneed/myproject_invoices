<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class CustomersReports extends Controller
{
    public function index(){
        $sections=Section::all();

return view('reports.CustomersReports',compact('sections'));

    }

public function Search_Customers(Request $request){




        // في حالة البحث بدون التاريخ
              
             if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {
        
               
              $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
              $sections = section::all();
               return view('reports.CustomersReports',compact('sections'))->withDetails($invoices);
        
            
             }
        
        
          // في حالة البحث بتاريخ
             
             else {
               
               $start_at = date($request->start_at);
               $end_at = date($request->end_at);
        
              $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
               $sections = section::all();
               return view('reports.CustomersReports',compact('sections'))->withDetails($invoices);
        
              
             }
             
          
            

}




}
