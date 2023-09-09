<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSection;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return '3690';
        $sec = Section::all();
        return view('sections.sections',compact('sec'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modals');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestSection $request)
    {
        // $input = $request->all();
        // $b_section = Section::where('section_name', '=', $input['section_name'])->exists();
        // if ($b_section) {

        //     session()->flash('Error', 'خطأ القسم مسجل مسبقا');
        //     return redirect('/sections');
        // } else {
            // $validated = $request->validate([
            //     'section_name' => 'required|unique:posts|max:255',
            //     'descripation' => 'required',
            // ]);


        // Section::create([
        //     'section_name' => $request->section_name,
        //     'descripation' => $request->descripation,
        //     'created_by' => (auth()->user()->name),
        // ]);
        // dd($request->validated());   
        Section::create($request->validated());
        session()->flash('Add', 'تمّ إضافة القسم بنجاح');
        return redirect('/sections');

        // }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //return view('sections.sections',compact('sec'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'descripation' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'descripation.required' =>'يرجي ادخال البيان',

        ]);

        $sections = section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'descripation' => $request->descripation,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $id = $request->id;
        section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
