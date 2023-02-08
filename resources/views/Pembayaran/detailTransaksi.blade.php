@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-light">Detail Transaksi</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    <table class="table table-borderless">
                       
                        <tr >
                            <td class="col-md-2  fw-bold">Tanggal Reservasi : {{  $history->reservasi->created_at  }}  </td>
                        </tr>
                        <tr >
                            <td class="col-md-2  ">Nama Pemesan : {{  $history->reservasi->pengunjung->nama  }}  </td>
                        </tr>
                       
                    </table>
                    <table class="table table-responsive table-stripped table-bordered">
                        <thead class="thead-light"> 
                            <td>#</td>
                            <td>Kode Ruangan</td>
                            <td>Tipe Kamar</td>
                            <td>Lama Sewa</td>
                            <td class="text-end" style="width:20%;">Harga Permalam</td>
                        </thead>
                        <tbody>
                                
                            <tr>
                            <td>1</td>
                            <td>{{ $history->reservasi->tbl_kamar->kode_ruangan }}</td>
                            <td>{{ $history->reservasi->tbl_kamar->tipe_kamar->nama_tipe }}</td>
                            <td>{{ $history->reservasi->lama_sewa }} Hari</td>
                            <td class="text-end">
                               Rp. {{number_format( $history->reservasi->tbl_kamar->tipe_kamar->harga) }}
                            </td>
                        </tr>

                        <tr class="text-end">
                            <td colspan="4" class="text-end">GranTotal</td>
                            <td>Rp. {{number_format( $history->reservasi->tbl_kamar->tipe_kamar->harga * $history->reservasi->lama_sewa )}}</td>
                        </tr>
                        <tr class="text-end">
                            <td colspan="4"class="text-end">Uang Bayar</td>
                            <td>Rp. {{number_format( $history->uang_bayar )}}</td>
                        </tr>
                        <tr class="text-end">
                            <td colspan="4"class="text-end">Uang Kembalian</td>
                            <td>Rp. {{number_format(($history->reservasi->tbl_kamar->tipe_kamar->harga * $history->reservasi->lama_sewa)- $history->uang_bayar )}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="/history/transaksi" class="btn btn-warning text-dark"><i class="fa fa-arrow-left" aria-hidden="true"> Kembali</i>
                    </a>


                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    function update(){
        document.getElementById("ubah").style.display = "inline";
        document.getElementById("hapus").style.display = "none";

    }
</script>
@endsection
