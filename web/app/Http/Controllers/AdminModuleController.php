<?php

namespace App\Http\Controllers;

use App\AdminModule;
use Illuminate\Http\Request;

class AdminModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = AdminModule::latest()->paginate(5);
        return view('admin-modules.index', compact('models'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminModule  $adminModule
     * @return \Illuminate\Http\Response
     */
    public function show(AdminModule $adminModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminModule  $adminModule
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminModule $adminModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminModule  $adminModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminModule $adminModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminModule  $adminModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminModule $adminModule)
    {
        //
    }
}
