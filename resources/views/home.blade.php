@extends('layouts.app')

@section('content')
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
                            <td>{{$item->created_at}}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-outline-danger">Detail</a>
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
                                <input onkeyup="searchCust(this)" type="text" class="form-control" name="nama_costumer" id="nama_costumer">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col-3">
                                <p>Nama Customer</p>
                            </div> --}}
                            <div class="col" id="customers">
                                <p id="customer-search" class="d-none bg-danger rounded-1 p-2 text-white fs-5 mb-2">
                                    </span class="fw-bold " style="letter-spacing: 2px"> 
                                        36791111222333444 
                                    <span>
                                    a/n Moreno Hernakov
                                    <button class="float-end btn btn-sm btn-light fw-bold ">Pesan!!</button>
                                </p>
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
                    console.log(res)
                },
                error: function(error) {
                    console.log(error)
                }
            });
            // console.log(e.value)
        }
    </script>
@endsection
