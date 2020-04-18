@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ubah Data Pelanggan</strong>
                            <small>{{ $item->name }}</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('customers.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama Pelanggan<span class="text-danger"> *</span></label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $item->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Pelanggan">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Alamat Lengkap<span class="text-danger"> *</span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan Alamat Lengkap Pelanggan" rows="3">{{ old('address') ? old('address') : $item->address}}</textarea>
                                    @error('address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="connection_status" class="form-control-label">Status Sambungan<span class="text-danger"> *</span></label><br>
                                    <div class="form-check-inline form-check">
                                        <label>
                                            <input type="radio" name="connection_status" value="inactive" class="form-check-input" {!! $item->connection_status == 0 ? 'checked' : '' !!}>
                                            Non-Aktif
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="connection_status" value="active" class="form-check-input" {!! $item->connection_status == 1 ? 'checked' : '' !!}>
                                            Aktif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group form-action">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
