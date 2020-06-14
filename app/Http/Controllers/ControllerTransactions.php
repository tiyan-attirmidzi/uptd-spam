<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DescriptionCost;
use App\Models\OtherCost;
use App\Models\Transaction;
use App\Models\UsageCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

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
        if ($this->timeNow->day >= 1  && $this->timeNow->day <= 30) {
            return view('pages.mix.enter_usage.index');
        }
        else {
            alert()->html('Tidak Dapat Menginput Tagihan',"Penginputan Hanya Dapat Dilakukan Pada <br> <b>Tanggal 1 sampai 5</b>",'warning');
            return redirect()->back();
        }
    }

    public function inputUsage(Request $request)
    {
        $idCustomer = $request->id_customer;
        $descriptionCosts = DescriptionCost::all();
        $otherCosts = OtherCost::all();

        $checkExistingData = Transaction::where('id_customer', $idCustomer)->whereMonth('created_at', $this->timeNow->month)->exists();


        if ($checkExistingData) {
            alert()->html('GAGAL',"Data Telah Diinputkan Dibulan Ini",'error');
            return redirect()->back();
        }

        $classOne = array();
        $classtwo = array();
        $classthree = array();

        $this->validate($request, [
            'billing_number' => 'required|numeric|exists:customers,billing_number',
            'usage' => 'required|numeric'
        ]);

        $dataUsage = UsageCustomer::firstOrnew([
            'id_customer' => $idCustomer
        ]);

        $dataUsageOld = $dataUsage->total_overall;

        $dataUsage->total_overall = $request->usage;
        $dataUsage->save();

        $dataUsagePerMonth = $dataUsage->total_overall - $dataUsageOld;

        for ($i = 1; $i <= $dataUsagePerMonth; $i++) {
            if ($i >= $descriptionCosts[0]->lower_limit && $i <= $descriptionCosts[0]->upper_limit) {
                $classOne[] = $i;
            }
            if ($i >= $descriptionCosts[1]->lower_limit && $i <= $descriptionCosts[1]->upper_limit) {
                $classtwo[] = $i;
            }
            if ($i >= $descriptionCosts[2]->lower_limit && $i <= $descriptionCosts[2]->upper_limit) {
                $classthree[] = $i;
            }
        }

        $usageCost = ($descriptionCosts[0]->price * count($classOne)) + ($descriptionCosts[1]->price * count($classtwo)) + ($descriptionCosts[2]->price * count($classthree));

        $newInputTranscation = new Transaction([
            'admin_fee' => $otherCosts[0]->price,
            'usage' => $dataUsagePerMonth,
            'usage_cost' => $usageCost,
            'total_payment' => $usageCost + $otherCosts[0]->price,
            'status' => Transaction::UNPAID_OFF,
            'id_customer' => $idCustomer
        ]);

        $newInputTranscation->save();

        alert()->html('BERHASIL',"Tagihan Berhasil Diinput",'success');
        return redirect()->back();

    }

    public function billingCheck(Request $request)
    {
        if ($this->timeNow->day >= 6 && $this->timeNow->day <= 30) {

            $this->validate($request, [
                'billing_number' => 'required|numeric|exists:customers,billing_number'
            ]);

            $billingNumber = $request->billing_number;
            $classOne = array();
            $classtwo = array();
            $classthree = array();

            $itemDescriptionCosts = DescriptionCost::all();
            $itemOtherCosts = OtherCost::all();

            $item = Transaction::whereMonth('created_at', $this->timeNow->month)->with('customer.usageCustomer')->whereHas('customer', function ($query) use ($billingNumber) {
                $query->where('billing_number', $billingNumber);
            })->firstOrFail();


            if ($this->timeNow->day > 20) {
                $item->fine = $itemOtherCosts[1]->price;
                $item->total_payment = $item->total_payment + $itemOtherCosts[1]->price;
            }

            $dataUsagePerMonth = $item->usage;

            for ($i = 1; $i <= $dataUsagePerMonth; $i++) {
                if ($i >= $itemDescriptionCosts[0]->lower_limit && $i <= $itemDescriptionCosts[0]->upper_limit) {
                    $classOne[] = $i;
                }
                if ($i >= $itemDescriptionCosts[1]->lower_limit && $i <= $itemDescriptionCosts[1]->upper_limit) {
                    $classtwo[] = $i;
                }
                if ($i >= $itemDescriptionCosts[2]->lower_limit && $i <= $itemDescriptionCosts[2]->upper_limit) {
                    $classthree[] = $i;
                }
            }

            $itemUsage = collect([
                [
                    'range' => "1 - 10",
                    'usage' => count($classOne),
                    'lower_limit' => $itemDescriptionCosts[0]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[0]->upper_limit,
                    'price' => $itemDescriptionCosts[0]->price,
                    'total_price' => $itemDescriptionCosts[0]->price * count($classOne)
                ],
                [
                    'range' => "11 - 20",
                    'usage' => count($classtwo),
                    'lower_limit' => $itemDescriptionCosts[1]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[1]->upper_limit,
                    'price' => $itemDescriptionCosts[1]->price,
                    'total_price' => $itemDescriptionCosts[1]->price * count($classtwo)
                ],
                [
                    'range' => "21 - Dst.",
                    'usage' => count($classthree),
                    'lower_limit' => $itemDescriptionCosts[2]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[2]->upper_limit,
                    'price' => $itemDescriptionCosts[2]->price,
                    'total_price' => $itemDescriptionCosts[2]->price * count($classthree)
                ]
            ]);


            if ($item->customer->connection_status == Customer::STATUS_INACTIVE) {
                alert()->error('Tidak Ada Tagihan','Pelanggan Berstatus Tidak Aktif')->autoClose(3000);
                return redirect()->back();
            }

            return view('pages.mix.transactions.check')->with([
                'item' => $item,
                'itemUsage' => $itemUsage,
            ]);
        }
        else {
             alert()->html('Tidak Dapat Membayar Tagihan',"Pembayaran Hanya Dapat Dilakukan Pada <br> <b>Tanggal 6 sampai 20</b>",'warning');

            return redirect()->back();
        }
    }

    public function pay($customer_id, $billing_number)
    {
        $classOne = array();
        $classtwo = array();
        $classthree = array();

        $itemDescriptionCosts = DescriptionCost::all();
        $itemOtherCosts = OtherCost::all();

        $item = Transaction::whereMonth('created_at', $this->timeNow->month)->with('customer.usageCustomer')->whereHas('customer', function ($query) use ($billing_number) {
            $query->where('billing_number', $billing_number);
        })->firstOrFail();

        if ($this->timeNow->day >= Transaction::DATE_PAY_EARLY && $this->timeNow->day <= Transaction::DATE_PAY_FINAL) {
            if ($this->timeNow->day > Transaction::DATE_PAY_FINAL) {
                $item->fine = $itemOtherCosts[1]->price;
                $item->total_payment = $item->total_payment + $itemOtherCosts[1]->price;
                $item->save();
            }

            $dataUsagePerMonth = $item->usage;

            for ($i = 1; $i <= $dataUsagePerMonth; $i++) {
                if ($i >= $itemDescriptionCosts[0]->lower_limit && $i <= $itemDescriptionCosts[0]->upper_limit) {
                    $classOne[] = $i;
                }
                if ($i >= $itemDescriptionCosts[1]->lower_limit && $i <= $itemDescriptionCosts[1]->upper_limit) {
                    $classtwo[] = $i;
                }
                if ($i >= $itemDescriptionCosts[2]->lower_limit && $i <= $itemDescriptionCosts[2]->upper_limit) {
                    $classthree[] = $i;
                }
            }

            $itemUsage = collect([
                [
                    'range' => "1 - 10",
                    'usage' => count($classOne),
                    'lower_limit' => $itemDescriptionCosts[0]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[0]->upper_limit,
                    'price' => $itemDescriptionCosts[0]->price,
                    'total_price' => $itemDescriptionCosts[0]->price * count($classOne)
                ],
                [
                    'range' => "11 - 20",
                    'usage' => count($classtwo),
                    'lower_limit' => $itemDescriptionCosts[1]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[1]->upper_limit,
                    'price' => $itemDescriptionCosts[1]->price,
                    'total_price' => $itemDescriptionCosts[1]->price * count($classtwo)
                ],
                [
                    'range' => "21 - Dst.",
                    'usage' => count($classthree),
                    'lower_limit' => $itemDescriptionCosts[2]->lower_limit,
                    'upper_limit' => $itemDescriptionCosts[2]->upper_limit,
                    'price' => $itemDescriptionCosts[2]->price,
                    'total_price' => $itemDescriptionCosts[2]->price * count($classthree)
                ]
            ]);

            $pdf = PDF::loadview('pages.mix.transactions.print', [$item, $itemUsage])->setPaper('A4','potrait');
            return $pdf->stream();
        }
        else {
            $n = "Pembayaran di tutup";
        }



    }

    public function transactionHistoryPerMonth(Request $request)
    {
        $route = $request->route()->getName();

        if ($route === 'transactions.unpaidoff') {
            $items = Transaction::whereMonth('created_at', $this->timeNow->month)->where('status', Transaction::UNPAID_OFF)->get();
        }
        else {
            $items = Transaction::whereMonth('created_at', $this->timeNow->month)->where('status', Transaction::ALREADY_PAID)->get();
        }

        return view('pages.mix.transactions.history.permonth.index');

    }


    public function transactionAllData()
    {

    }

}
