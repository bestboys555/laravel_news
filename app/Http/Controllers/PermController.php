<?php

namespace App\Http\Controllers;

use App\Perm;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:perm-list|perm-create|perm-edit|perm-delete', ['only' => ['index','show']]);
        $this->middleware('permission:perm-create', ['only' => ['create','store']]);
        $this->middleware('permission:perm-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:perm-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms = Perm::latest()->orderBy('name', 'desc')->paginate(20);
        return view('management.perm.index',compact('perms'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perms_select = Perm::pluck('name','id')->all();
        return view('management.perm.create',compact('perms_select'));
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
            'name' => 'required',
        ]);
        Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'ref_id' => $request->ref_id
            ]);
        return redirect()->route('perm.index')->with('success','Permision created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perm  $perm
     * @return \Illuminate\Http\Response
     */
    public function show(Perm $perm)
    {
        return view('management.perm.show',compact('perm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perm  $perm
     * @return \Illuminate\Http\Response
     */
    public function edit(Perm $perm)
    {
        $perms_select = Perm::pluck('name','id')->all();
        return view('management.perm.edit',compact('perm','perms_select'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perm  $perm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perm $perm)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $perm->update($request->all());
        return redirect()->route('perm.index')
                        ->with('success','Permision updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perm  $perm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perm $perm)
    {
        $perm->delete();
        return redirect()->route('perm.index')->with('success','Permision deleted successfully');
    }
}
