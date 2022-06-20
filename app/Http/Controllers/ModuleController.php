<?php

namespace App\Http\Controllers;


use App\Teacher;
use App\Module;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::with('teacher')->latest()->paginate(10);
        
        return view('backend.modules.index', compact('modules'));
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

        return view('backend.modules.create', compact('teachers','modules'));
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
            'module_code'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        Module::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
        
            'teacher_id'    => $request->teacher_id,
            'module_code'    => $request->module_code,
            'description'   => $request->description
        ]);

        return redirect()->route('module.index');
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
    public function edit(Module $module)
    {
        $teachers = Teacher::latest()->get();
        $modules = Module::latest()->get();
        return view('backend.modules.edit', compact('module','teachers','modules'));
    }
    public function editb(Module $module)
    {
        $teachers = Teacher::latest()->get();
        $modules = Module::latest()->get();
        return view('backend.module.edit', compact('module','teachers','modules'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:modules,name,'.$module->id,
            'module_code'    => 'required|numeric',
            'teacher_id'    => 'required|numeric',
           
            'description'   => 'required|string|max:255'
        ]);

        $module->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'teacher_id'    => $request->teacher_id,
            'module_code'   => $request->module_code,
            'description'   => $request->description
        ]);

        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back();
    }
}
