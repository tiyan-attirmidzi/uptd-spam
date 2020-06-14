@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Uraian Biaya</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Batas Bawah</th>
                                        <th>Batas Atas</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $index => $item)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $item->lower_limit }}</td>
                                            <td>{{ $item->lower_limit == 21 ? "Dst." : $item->upper_limit }}</td>
                                            <td>Rp. {{ number_format($item->price) }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <a href="{{ route('description_costs.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil"></i> Ubah
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">
                                                Data Tidak Ada
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

