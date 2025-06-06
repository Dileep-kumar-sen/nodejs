<?php

namespace App\Http\Controllers;

use App\Models\testing;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testing=testing::all();
        return response()->json(['message'=>200,'data'=>$testing]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // testing::create([
        //   'name'=>'dileep kumar sen',
        //   'full_name'=>'sen caste i have'
        // ]);
        $testing=new testing();
        $testing->name="dileep kumar";
        $testing->full_name="i am ";
        $testing->save();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testing=testing::find(2);
        return $testing;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'full_name'=>'required'
        ]);
        $testing = testing::findOrFail($id); // always better to use findOrFail
    $testing->update([
        'name' => $request->name,
        'full_name' => $request->full_name,
    ]);

    return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $find=testing::find($id);
        $find->delete();
    }
}
