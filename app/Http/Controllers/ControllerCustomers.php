<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCustomer;
use App\Models\Customer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControllerCustomers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Customer::all();

        return view('pages.mix.customers.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.mix.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCustomer $request)
    {
        if ($request->connection_status == 'active') {
            $connectionStatus = Customer::STATUS_ACTIVE;
        }
        else {
            $connectionStatus = Customer::STATUS_INACTIVE;
        }

        $newCustomer = new Customer([
            'billing_number' => date('Ymdhis').rand(0000, 9999),
            'name' => $request->name,
            'address' => $request->address,
            'connection_status' => $connectionStatus
        ]);

        if ($newCustomer->save()) {
            toast('Registrasi Pelanggan Baru Berhasil','success')->autoClose(3000);
            return redirect()->route('customers.index');
        }

        alert()->error('Terjadi Kesalahan','Periksa Kembali Inputan Anda')->autoClose(3000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Customer::findOrFail($id);

        return view('pages.mix.customers.edit')->with([
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
        if ($request->connection_status == 'active') {
            $connectionStatus = Customer::STATUS_ACTIVE;
        }
        else {
            $connectionStatus = Customer::STATUS_INACTIVE;
        }

        $data = Customer::findOrFail($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->connection_status = $connectionStatus;

        if ($data->save()) {
            toast('Data Pelanggan Berhasil Diubah','success')->autoClose(3000);
            return redirect()->route('customers.index');
        }

        alert()->error('Terjadi Kesalahan','Periksa Kembali Inputan Anda')->autoClose(3000);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Customer::findOrFail($id);
        $item->delete();
    }
}
