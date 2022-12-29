<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;



class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Data::all();
        return view('data.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.create');
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
            'id'=>'required|min:8|max:10',
            'nama'=>'required|min:8|max:255',
            'nilai'=>'required',
        ]);
        $data = new Data;
        $data->id=$request->id;
        $data->nama=$request->nama;
        $data->nilai=$request->nilai;
        $data->save();
        return to_route('data.index')->with('Success Adding Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        //
        $data = Data::find($data);
        if(!$data){
            abort(404);
        }
        return view('data.detail')
        ->with("data", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {
        $data = Data::find($data);
        if(!$data){
            abort(404);
        }
        return view('data.edit')
        ->with("data", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        //
        $request->validate([
            'nama'=>'required|min:8|max:255',
            'nilai'=>'required',
        ]);
        $data = Data::find($data);
        if(!$data){
            abort(404);
        }
        $data->nama=$request->nama;
        $data->nilai=$request->nilai;
        $data->save();
        return to_route('data.index')->with('Success Adding Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        //
        $data = Data::find($data);       
        $data-> delete();                 

        return to_route('data.index')->with('success', 'data deleted');
    }
}
