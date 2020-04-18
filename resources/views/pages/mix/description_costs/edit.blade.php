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
                            <form action="{{ route('description_costs.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="lower_limit" class="form-control-label">Batas Bawah<span class="text-danger"> *</span></label>
                                    <input type="text" name="lower_limit" value="{{ old('lower_limit') ? old('lower_limit') : $item->lower_limit }}" class="form-control @error('lower_limit') is-invalid @enderror" disabled>
                                    @error('lower_limit')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="upper_limit" class="form-control-label">Batas Bawah<span class="text-danger"> *</span></label>
                                    <input type="text" name="upper_limit" value="{{ old('upper_limit') ? old('upper_limit') : $item->upper_limit }}" class="form-control @error('upper_limit') is-invalid @enderror" disabled>
                                    @error('upper_limit')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Harga<span class="text-danger"> *</span></label>
                                    <input type="number" name="price" value="{{ old('price') ? old('price') : $item->price }}" class="form-control @error('price') is-invalid @enderror" placeholder="Masukkan Nominal Harga">
                                    @error('price')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Deskripsi<span class="text-danger"> *</span></label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan Deskripsi" rows="3">{{ old('description') ? old('description') : $item->description}}</textarea>
                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
