@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Biaya Lainnya</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keteranagan</th>
                                        <th>Biaya</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $index => $item)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>Rp. {{ number_format($item->price) }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-edit-modal" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
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

    <div class="modal modal-primary fade" id="modal-edit" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Item</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <input type="hidden" name="eid" id="eid">
                        <div class="form-group">
                            <label for="ename">Nama</label>
                            <input type="text" class="form-control" name="ename" id="ename" readonly>
                        </div>
                        <div class="form-group">
                            <label for="eprice">Biaya</label>
                            <input type="number" class="form-control" name="eprice" id="eprice" placeholder="Masukkan Biaya" required>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary edit" id="btn-save" data-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- /Attachment Modal -->
@endsection

@push('script-modal-edit')
    <script>

        jQuery(document).ready(function ($) {

            $(document).on('click', '.btn-edit-modal', function () {
                $('.form-horizontal').show();
                $('#eid').val($(this).data('id'));
                $('#ename').val($(this).data('name'));
                $('#eprice').val($(this).data('price'));
                $('#modal-edit').modal('show');
            });

            $('.modal-footer').on('click', '.edit', function() {
                $.ajax({
                    type: 'POST',
                    url: '/sop/other_costs/update',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        '_method': 'PATCH',
                        'id': $("#eid").val(),
                        'name': $('#ename').val(),
                        'price': $('#eprice').val()
                    },
                    success: function (data) {
                        location.reload();
                    },
                    error: function (e) {
                        // console.log(e);
                    }
                });
            });
        });
    </script>

@endpush

