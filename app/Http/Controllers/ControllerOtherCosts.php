<?php

namespace App\Http\Controllers;

use App\Models\OtherCost;
use Illuminate\Http\Request;

class ControllerOtherCosts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = OtherCost::all();

        return view('pages.mix.other_costs.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = OtherCost::findorFail($request->id);
        $item->name = $request->name;
        $item->price = $request->price;

        $item->save();

        return response()->json($item);
    }
}
