<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControllerTransactions extends Controller
{
    protected $timeNow;

    public function __construct()
    {
        $this->timeNow = Carbon::now();
    }

    public function index()
    {
        return view('pages.mix.transactions.index');
    }

    public function fetchCustomerActive(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $items = Customer::orderby('billing_number','asc')
                ->limit(5)
                ->get();
        }else{
            $items = Customer::orderby('billing_number','asc')
                ->where('connection_status', 1)
                ->where('billing_number', 'LIKE', "%{$search}%")
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach($items as $item){
            $response[] = array(
                "id" => $item->id,
                "name" => $item->name,
                "label" => $item->billing_number,
                "address" => $item->address
            );
        }

        echo json_encode($response);
        exit;
    }

    public function inputUsageShow()
    {
        if ($this->timeNow->day >= 1  && $this->timeNow->day <= 28)
            return view('pages.mix.enter_usage.index');
        else {
            alert()->warning('Tidak Dapat Menginput Tagihan','Penginputan Hanya Dilakukan Pada Tanggal 1 sampai 5');
            return redirect()->back();
        }

    }

    public function inputUsage(Request $request)
    {
        $this->validate($request, [
            'billing_number' => 'required|numeric|exists:customers,billing_number',
            'usage' => 'required|numeric'
        ]);

        return $request->all();
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
        if ($this->timeNow->day >= 1 && $this->timeNow->day <= 20)
            $n = "Bisa melakukan pembayaran";
        else
            $n = "Pembayaran di tutup";

        return view('pages.mix.transactions.pay');
    }

}
