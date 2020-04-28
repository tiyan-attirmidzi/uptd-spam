@extends('layouts.dashboard')

@stack('style-chosen')

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Input Tagihan Bulanan</strong> <small id="mount-name"></small>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('transactions.input.usage') }}" method="POST">
                                @csrf
                                 <div class="form-group">
                                    <label for="billing_number" class="form-control-label">Nomor Pembayaran<span class="text-danger"> *</span></label>
                                    <input type="number" name="billing_number" id="billing_number" value="{{ old('billing_number') }}" class="form-control @error('billing_number') is-invalid @enderror" placeholder="Masukkan Nomor Pembayaran Pelanggan">
                                    @error('billing_number')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                     <label for="full_name" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                     <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" readonly>
                                     <input type="hidden" name="id_customer" id="id_customer" class="form-control" value="{{ old('id_customer') }}" readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="address" class="form-control-label">Alamat Lengkap<span class="text-danger"> *</span></label>
                                     <textarea name="address" class="form-control"  id="address" rows="3" readonly>{{ old('address') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="usage" class="form-control-label">Pemakaian (M<sup>3</sup>)<span class="text-danger"> *</span></label>
                                    <input type="number" name="usage" id="usage" value="{{ old('usage') }}" class="form-control @error('usage') is-invalid @enderror" placeholder="Masukkan Pemakaian">
                                    @error('usage')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                 </div>
                                <div class="form-group form-action">
                                    <button type="submit" class="btn btn-primary">Input</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-chosen')

    <script type="text/javascript">

        timeNow = new Date();
        arrBulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        var nameMonth = document.getElementById("mount-name");
        nameMonth.innerHTML = arrBulan[timeNow.getMonth()];

        jQuery(document).ready(function($){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $( "#billing_number" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                        url:"{{route('transactions.fetch')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#id_customer').val(ui.item.id);
                    $('#billing_number').val(ui.item.label);
                    $('#name').val(ui.item.name);
                    $('#address').val(ui.item.address);
                    return false;
                }
            });

        });

    </script>
@endpush

