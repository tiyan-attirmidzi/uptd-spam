@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Registrasi Pelanggan Baru</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('customers.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama Pelanggan<span class="text-danger"> *</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Pelanggan">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Alamat Lengkap<span class="text-danger"> *</span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan Alamat Lengkap Pelanggan" rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-action">
                                    <button type="submit" class="btn btn-primary">Registrasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
