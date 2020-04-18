@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cek Pembayaran</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('transactions.check') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="billing_number" class="form-control-label">Nomor Tagihan Pelanggan<span class="text-danger"> *</span></label>
                                    <input type="text" name="billing_number" value="{{ old('billing_number') }}" class="form-control @error('billing_number') is-invalid @enderror" placeholder="Masukkan Nomor Tagihan Pelanggan">
                                    @error('billing_number')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-action">
                                    <button type="submit" class="btn btn-primary btn-block">Cek</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
