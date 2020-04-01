@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Registrasi Pengguna (User) Baru</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Pengguna">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Alamat Email<span class="text-danger"> *</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email Pengguna">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Kata Sandi<span class="text-danger"> *</span></label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Kata Sandi">
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-control-label">Ulang Kata Sandi<span class="text-danger"> *</span></label>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan Ulang Kata Sandi">
                                    @error('password_confirmation')
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
