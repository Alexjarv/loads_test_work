<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoadsResource;
use Illuminate\Http\Request;
use App\Models\Load;
use App\Models\Point;

class LoadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // all loads

        $loads = Load::factory()->count(20)->make();
        //$loads = Load::join('points', 'points.load_id', '=', 'loads.id')->orderBy('points.date', 'DESC')->get();
        return response()->json($loads, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'weight' => 'required|max:255',
            'from' => 'required|max:255',
            'to' => 'required|max:255',
        ]);

        $load = new Load;
        $load->title = $request->title;
        $load->weight = $request->weight;
        $load->save();

        $point = new Point;
        $point->name = $request->from . " - " . $request->to;
        $point->load_id = $load->id;
        $point->save();

        return response()->json(new LoadsResource($load), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // one load
        return response()->json(Load::with('points')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update load
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete load
    }
}
