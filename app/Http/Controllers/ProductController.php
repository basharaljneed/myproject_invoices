<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Product $prd)
    public function index()
    {
        // dd($prd);
        $sec = Section::all();
        //         $prd=Product::with('refps')->all();
        $prd = Product::all();

        // $prd=Product::with('refps')->find(1);
        // dd($prd);
        //    $prd=Product::find(1);
        // $prd->load('refps');
        // dd($prd);
        // $sec = Section::find(1);

        return view('product.product', compact('sec', 'prd'));
        //return $prd->refps;

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
        // return $request;
        Product::create([
            'product_name' => $request->product_name,
            'product_des' => $request->product_des,
            'product_id' => $request->product_id,
        ]);
        session()->flash('Add', 'تمّ إضافة المنتج بنجاح');

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //$ssid=Section::where('section_name',$request->section_name)->first()->pluck('id');
        $ssid = Section::where('section_name', $request->section_name)->first()->id;
        $prod_id = Product::find($request->pro_id);

        $prod_id->update([
            'product_name' => $request->product_name,
            'product_des' => $request->product_des,
            'product_id' => $ssid,
        ]);
        session()->flash('edite', 'تمّ التعديل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $prod_del_id = Product::find($request->pro_id);
        $prod_del_id->delete();
        session()->flash('delt', 'تمّ الحذف ');
        return back();
    }
}
