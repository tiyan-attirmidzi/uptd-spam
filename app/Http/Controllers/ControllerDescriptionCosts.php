<?php

namespace App\Http\Controllers;

use App\Models\DescriptionCost;
use Illuminate\Http\Request;

class ControllerDescriptionCosts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DescriptionCost::all();

        return view('pages.mix.description_costs.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = DescriptionCost::findOrFail($id);

        return view('pages.mix.description_costs.edit')->with([
            'item' => $item
        ]);
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
        $data = DescriptionCost::findOrFail($id);
        $data->price = $request->price;
        $data->description = $request->description;

        if ($data->save()) {
            toast('Data Uraian Biaya Berhasil Diubah','success')->autoClose(3000);
            return redirect()->route('description_costs.index');
        }

        alert()->error('Terjadi Kesalahan','Periksa Kembali Inputan Anda')->autoClose(3000);
        return redirect()->back();
    }

}
