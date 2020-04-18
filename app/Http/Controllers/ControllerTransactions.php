<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ControllerTransactions extends Controller
{
    public function index()
    {
        return view('pages.mix.transactions.index');
    }

    public function billingCheck(Request $request)
    {
        $this->validate($request, [
            'billing_number' => 'required|numeric|exists:customers,billing_number'
        ]);

        $item = Customer::where('billing_number', $request->billing_number)->firstOrFail();

        if ($item->connection_status == Customer::STATUS_INACTIVE) {
            alert()->error('Tidak Ada Tagihan','Pelanggan Berstatus Tidak Aktif')->autoClose(3000);
            return redirect()->back();
        }

        return view('pages.mix.transactions.check')->with([
            'item' => $item
        ]);
    }

    public function pay()
    {
        return view('pages.mix.transactions.pay');
    }
}
