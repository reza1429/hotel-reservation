@extends('layouts.app')

@section('content')

    {{-- detail reservasi modal --}}
    @foreach ($reservasi as $detail)
    <div class="modal fade" id="modal-detail{{$detail->id}}">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pengunjung</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                <table class="table table-borderless">
                <tr>
                    <td>NIK : {{$detail->pengunjung->no_ktp}}</td>
                </tr>
                <tr>
                    <td>NAMA : {{$detail->pengunjung->nama}}</td>
                </tr>
                <tr>
                    <td>ALAMAT : {{$detail->pengunjung->alamat}}</td>
                </tr>
                <tr>
                    <td>NO. Telp : {{$detail->pengunjung->no_telp}}</td>
                </tr>
                <tr>
                    <td>TIPE RUANGAN : {{$detail->tbl_kamar->tipe_kamar->nama_tipe}}</td>
                </tr>
                <tr>
                    <td>KODE RUANGAN : {{$detail->tbl_kamar->kode_ruangan}}</td>
                </tr>
                <tr>
                    <td>TANGGAL CHECK-IN : {{$detail->created_at->format('l, j F Y H:i')}}</td>
                </tr>
                <tr><?php
                    $in = strtotime($detail->created_at);
                    $out = (int)$detail->lama_sewa*60*60*24;
                    $final = $out + $in;
                    ?>
                    <td>TANGGAL CHECK-OUT : <?=date('l, j F Y H:i', $final )?></td>
                </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="container">
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-danger">
                <h4 class="m-0 fw-bold text-white">Reservasi</h4>
            </div>
            <div class="card-body ">
                <table class="table table-borderless table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Tipe kamar</th>
                            <th>Kode ruang</th>
                            <th>Tanggal Booking</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->pengunjung->no_ktp}}</td>
                            <td>{{$item->tbl_kamar->tipe_kamar->nama_tipe}}</td>
                            <td>{{$item->tbl_kamar->kode_ruangan}}</td>
                            <td>{{$item->created_at->format('l, j F Y H:i')}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-detail{{$item->id}}">Detail</button>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            {{-- input cust --}}
            <div class="col-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-danger">
                        <h4 class="m-0 fw-bold text-white">
                            Pelanggan
                            <button class="btn btn-sm btn-outline-light fw-bold px-3 rounded-4">
                                tambah
                                <i class="fa fa-plus fa"></i>
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-3">
                                <p class="m-0 ">NIK</p>
                            </div>
                            <div class="col">
                                <input onkeyup="searchCust(this)" type="number" class="form-control" name="nama_costumer" id="nama_costumer" autofocus>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col-3">
                                <p>Nama Customer</p>
                            </div> --}}
                            <div class="col" id="customers">
                            </div>
                            {{-- <form action="">
                                <div class="form-group">
                                  <input type="submit" name="" id="" class="btn btn-success" value="Pesan" aria-describedby="helpId">
                                  <input type="submit" name="" id="" class="btn btn-secondary" value="reset" aria-describedby="helpId">
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- tipe kamar --}}
            <div class="col">
                <div class="card border-0 shadow-lg text-center">
                    <div class="card-header bg-danger">
                        <h4 class="fw-bold m-0 text-white">Tipe Kamar</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tipe</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipe as $item )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_tipe}}</td>
                                    <td>{{number_format($item->harga)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchCust(e){
            let textvalx = $('#customer-search')
            // textvalx.removeClass("d-none");
            // textvalx.text(e.value)
            let val = e.value
            $.ajax({
                url: "/search/customer",
                type:"GET",
                data:{ val },
                success: function(res){
                    // if(res.success){
                    //     alert(res.message)
                    // }
                    $("#customers").html(res.html)
                    // console.log(res)
                },
                error: function(error) {
                    console.log(error)
                }
            });
            // console.log(e.value)
        }
    </script>
@endsection
