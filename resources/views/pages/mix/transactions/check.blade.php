@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('transactions.pay', ['customer_id' => $item->customer->id, 'billing_number' => $item->customer->billing_number]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <h1>Pelanggan</h1>
                                        <div class="mt-2">
                                            @if ($item->customer->connection_status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Non-Aktif</span>
                                            @endif
                                            <h4>{{ $item->customer->billing_number }}</h4>
                                            <h4><strong>{{ $item->customer->name }}</strong></h4>
                                            <p>{{ $item->customer->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h1 class="mb-2">Pemakaian</h1>
                                        <h4>{{ $item->usage }} M<sup>3</sup> <span class="badge badge-primary" id="month-name">Bulan Ini</span></h4>
                                        <h4>{{ $item->customer->usageCustomer->total_overall }} M<sup>3</sup> <span class="badge badge-secondary">Keseluruhan</span></h4>
                                    </div>
                                    <div class="col">
                                        <h1 class="mb-2">Biaya</h1>
                                        <h3><strong>Rp. {{ number_format($item->total_payment, 0, ".", ".") }}</strong></h3>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h3 class="text-center">Rincian Biaya</h3>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th colspan="4" class="text-center">Pemakaian</th>
                                        </tr>
                                        @for($i = 0; $i < count($itemUsage); $i++)
                                            <tr>
                                                <td>{{ $itemUsage[$i]['range'] }}</td>
                                                <td>Rp. {{ number_format($itemUsage[$i]['price'], 0, ".", ".") }}</td>
                                                <td>{{ $itemUsage[$i]['usage'] }}</td>
                                                <td>Rp. {{ number_format($itemUsage[$i]['total_price'], 0, ".", ".") }}</td>
                                            </tr>
                                        @endfor
                                    <tr>
                                        <th colspan="3" class="text-center">Total Biaya Pemakaian</th>
                                        <td>Rp. {{ number_format($item->usage_cost, 0, ".", ".") }}</td>
                                    </tr>
                                        <th colspan="3" class="text-center">Biaya Admin</th>
                                        <td>Rp. {{ number_format($item->admin_fee, 0, ".", ".") }}</td>
                                    </tr>
                                        <th colspan="3" class="text-center">Biaya Denda</th>
                                        <td>Rp. {{ number_format($item->fine, 0, ".", ".") }}</td>
                                    </tr>
                                        <th colspan="3" class="text-center">Total Keseluruhan</th>
                                        <td><strong>Rp. {{ number_format($item->total_payment, 0, ".", ".") }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="form-group form-action">
                                    <button type="submit" class="btn btn-primary btn-block">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
