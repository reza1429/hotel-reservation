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
                            &nbsp;
                            <button class="btn btn-sm btn-light fw-bold px-3 rounded-5" data-bs-toggle="modal" data-bs-target="#modal-tambahPengunjung">tambah +</button>
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
                                    <button class="float-end btn btn-sm btn-light fw-bold " data-bs-toggle="modal" data-bs-target="#modal-tambahReservasi{{$item->id}}">Pesan!!</button>
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

    <!-- modal tambah pengunjung -->
    <div class="modal fade" id="modal-tambahPengunjung">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengunjung</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('pengunjung.store') }}" enctype="multipart/form-data">
                    @csrf
                    <p>Nama Pengunjung</p>
                    <input class="form-control" type="text" name="nama" id="nama">

                    <p>Alamat Pengunjung</p>
                    <input class="form-control" type="text" name="alamat" id="alamat">

                    <p>No KTP Pengunjung</p>
                    <input class="form-control" type="text" name="no_ktp" id="no_ktp">

                    <p>No. Telp Pengunjung</p>
                    <input class="form-control" type="text" name="no_telp" id="no_telp"><br>
                    
                    <input type="submit" class="btn btn-success" value="simpan">
                    <a href="{{ route('home') }}" class="btn btn-danger">Batal</a>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal tambah reservasi -->
    <div class="modal fade" id="modal-tambahReservasi">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Reservasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('reservasi.store') }}" enctype="multipart/form-data">
                    @csrf
                    @foreach ($reservasi as $addreservasi)
                    <input type="hidden" name="id_pengunjung" value="{{ $addreservasi->id }}">
                    <p>Nama Pengunjung</p>
                    <input class="form-control" type="text" name="nama" id="nama" value="{{ $addreservasi->nama }}" aria-label="Disabled input example" disabled readonly>

                    <p>No KTP Pengunjung</p>
                    <input class="form-control" type="text" name="no_ktp" id="no_ktp" value="{{ $addreservasi->no_ktp }}" aria-label="Disabled input example" disabled readonly>

                    <p>No. Telp Pengunjung</p>
                    <input class="form-control" type="text" name="no_telp" id="no_telp" value="{{ $addreservasi->no_telp }}" aria-label="Disabled input example" disabled readonly>

                    <p>Alamat Pengunjung</p>
                    <input class="form-control" type="text" name="alamat" id="alamat" value="{{ $addreservasi->alamat }}" aria-label="Disabled input example" disabled readonly>
                    @endforeach    

                    <p>Lama Sewa</p>
                    <input class="form-control" type="text" name="no_ktp" id="no_ktp">
                    
                    <p>Status Pasien</p>
                    <select class="form-select form-control" name="status" id="status">
                        <!-- <option selected disabled>Pilih Jenis Kelamin</option> -->
                        <option value="rawat">Dirawat</option>
                        <option value="kembali">Kembali ke kelas</option>
                        <option value="pulang">Dipulangkan</option>
                        <option value="rujuk">Dirujuk</option>
                    </select>
                    
                    <input type="submit" class="btn btn-success" value="simpan">
                    <a href="{{ route('home') }}" class="btn btn-danger">Batal</a>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal detail reservasi -->
    @foreach ($reservasi as $detail)
    <div class="modal fade" id="modal-detail{{$detail->id}}">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Reservasi</h4>
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

    <script>
        function detailCust(e){
            let textvalx = $('#modal-detail')
            // textvalx.removeClass("d-none");
            // textvalx.text(e.value)
            let val_detail = e.value
            $.ajax({
                url: "/detail/customer",
                type:"GET",
                data:{ val_detail },
                success: function(res){
                    // if(res.success){
                    //     alert(res.message)
                    // }
                    $("#modal-detail").html(res.html)
                    console.log(res)
                },
                error: function(error) {
                    console.log(error)
                }
            });
            // console.log(e.value)
        }
    </script>

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
