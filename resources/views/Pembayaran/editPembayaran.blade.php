@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-danger text-light">Edit Pengunjung</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)

                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}

                    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        </div>
                         <div class="form-group mt-3">
                            <label for="nama" class="mx-1">Kode Pembayaran :</label>
                        <input type="text" class="form-control" id="kode_bayar" placeholder="Kode Pembayaran" readonly name="kode_bayar" value="{{ $pembayaran->kode_bayar }}">
                        </div>
                         <div class="form-group  mt-2">
                            <label for="alamat" class="mx-1">Total Harga :</label>
                        <input type="text" class="form-control " id="grandtotal" placeholder="Total Bayar" readonly name="total_harga" value="{{ $pembayaran->total_harga}}">
                        </div>
                        
                        <div class="form-group mt-2">
                            <label for="ktp" class="mx-1">Uang Bayar :</label>

                            <input type="number" class="form-control" id="uangbayar" placeholder="Uang Bayar" name="uang_bayar" min="{{ $pembayaran->total_harga }}" value="0">
                        </div>
                        <div class="form-group mt-2">
                            <label for="ktp" class="mx-1">Kembalian :</label>

                            <input type="number" class="form-control" id="uangkembalian" placeholder="Uang Bayar" disabled name="uang_bayar" min="{{ $pembayaran->total_harga }}" value="0">
                        </div>
                        
                        <div class="form-group mt-3">
                            <input  type="submit" class="btn btn-sm btn-success" value="Submit">
                            <input type="reset" class="btn btn-sm btn-warning text-light">
                            <a href="/pembayaran" class="btn btn-sm btn-danger">Kembali</a>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" >
   
    document.addEventListener("DOMContentLoaded", function(){
     var grandtotal =  document.getElementById("grandtotal").value;
    var uangbayar =  document.getElementById("uangbayar").value;
    });
    document.getElementById("uangbayar").addEventListener("change", function(){
     var grandtotal =  document.getElementById("grandtotal").value;
    var uangbayar =  document.getElementById("uangbayar").value;
    let kembalian = document.getElementById("uangkembalian").value = uangbayar-grandtotal;
    });
    
    
    

</script>
@endsection
