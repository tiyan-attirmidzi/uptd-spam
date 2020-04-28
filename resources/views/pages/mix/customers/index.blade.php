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
                                        <th>Nomor Pembayaran</th>
                                        <th>Nama</th>
                                        <th>Status Sambungan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $index => $item)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $item->billing_number }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->connection_status == 1)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary">Non-Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('customers.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil"></i> Ubah
                                                </a>
                                                <button class="btn btn-danger btn-sm deleteConfirm" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
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

@push('alert-confirm-delete')
    <script>

      $(document).ready(function(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.deleteConfirm').click(function(e){
          e.preventDefault();
          var id = $(this).data('id');
          console.log(id);
          swal({
              title: 'Anda yakin menghapus?',
              text: 'Data ini akan dihapus secara permanen',
              icon: 'warning',
              buttons: ["Batal", "Ya"],
          }).then(function (e) {
            $.ajax({
              type: "POST",
              url: "{{ url('customers/delete') }}",
              data: {id:id},
              success: function (data) {
                console.log("sukses");
              },
              error: function (e) {
                // console.log(e);
              }
            });
          });
        });
      });
    </script>
@endpush
