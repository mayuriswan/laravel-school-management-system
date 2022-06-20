<?php

namespace App\Http\Controllers;


use App\Teacher;
use App\Module;
use App\Fillier;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class FillierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Fillier::with('teacher')->latest()->paginate(10);
        
        
        return view('backend.filliers.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::latest()->get();
        $modules = Module::latest()->get();

        return view('backend.filliers.create', compact('teachers','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:modules',
            
            'teacher_id'    => 'required|numeric',
            
            'description'   => 'required|string|max:255'
        ]);

        Fillier::create([
            'fillier_name'          => $request->name,
            
        
            'teacher_id'    => $request->teacher_id,
            
            'fillier_description'   => $request->description
        ]);

        return redirect()->route('filliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = Teacher::latest()->get();
       $subject = Fillier::where('id',$id)->first(); 
        return view('backend.filliers.edit', compact('subject','teachers'));
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fillier =Fillier::where('id',$id)->first(); 
        

        $fillier->update([
            'fillier_name'          => $request->name,
           
            'teacher_id'    => $request->teacher_id,
            
            'fillier_description'   => $request->description
        ]);

        return redirect()->route('filliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fillier $fillier)
    {
        $fillier->delete();

        return back();
    }
}
