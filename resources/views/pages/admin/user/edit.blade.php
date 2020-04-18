@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ubah Data Pengguna (User)</strong>
                            <small>{{ $item->name }}</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('users.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $item->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Pengguna">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Alamat Email<span class="text-danger"> *</span></label>
                                    <input type="email" name="email" value="{{ old('email') ? old('email') : $item->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email Pengguna">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_admin" class="form-control-label">Hak Akses<span class="text-danger"> *</span></label>
                                    <select name="is_admin" id="is_admin" class="form-control">
                                        <option value="0">Officer</option>
                                    </select>
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
