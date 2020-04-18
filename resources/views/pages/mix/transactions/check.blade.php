@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customers.store') }}" method="POST">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col">
                                        <h1>Pelanggan</h1>
                                        <div class="mt-2">
                                            @if ($item->connection_status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Non-Aktif</span>
                                            @endif
                                            <h4>{{ $item->billing_number }}</h4>
                                            <h4><strong>{{ $item->name }}</strong></h4>
                                            <p>{{ $item->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h1 class="mb-2">Pemakaian</h1>
                                        2 of 3
                                    </div>
                                    <div class="col">
                                        <h1 class="mb-2">Biaya</h1>
                                        3 of 3
                                    </div>
                                </div>
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
