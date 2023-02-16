@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-light">History Transaksi</div>

                <div class="card-body">
                    

                    {{-- {{ __('You are logged in!') }} --}}
                    <div class="table-responsive-md">
                    <table class="table table-stripped ">
                        <thead class="thead-light fw-bold" >
                            <td>#</td>
                            <td style="width:30%;" class="text-center">Kode Bayar</td>
                            <td class="text-center" style="width:15%;">ID Reservasi</td>
                            <td style="width:20%;" class="text-end">Total Harga</td>
                            <td style="width:20%;" class="text-end">Uang Bayar</td>
                            <td style="width:15%;" class="text-center">Action</td>
                        </thead>
                        <tbody>
                            @foreach ($histories as $i => $history)
                                
                            <tr>
                            <td>{{ $histories->firstItem()+$i }}.</td>
                            <td class="text-center">{{ $history->kode_bayar }}</td>
                            <td class="text-center">{{ $history->id }}</td>
                            <td class="text-end">{{number_format( $history->total_harga) }}</td>
                            <td class="text-end">{{number_format( $history->uang_bayar) }}</td>

                           
                            <td class="text-center">
                                                                    
                    <a type="button" href="{{ route('pembayaran.show', $history->id) }}" class="btn btn-sm btn-success text-light "><i class="fa fa-info" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

                        <p class="mb-3 h6 text-dark ">Menampilkan {{ $histories ->firstItem() }} - {{ $histories ->lastItem()  }} data dari total  {{ $histories  ->total() }} data</p>
                            {{$histories->links()}}

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
