@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Pengguna (User)</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Hak Akses</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $index => $item)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->is_admin == 1)
                                                    <span class="badge badge-success">Admin</span>
                                                @else
                                                    <span class="badge badge-dark">Officer</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil"></i> Ubah
                                                </a>
                                                <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline" onclick="return confirm('Anda Yakin Ingin Menghapus?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
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


@push('data-table')
    @include('includes.script_datatable')
@endpush
