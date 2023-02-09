@extends('layouts.app')

@section('content')

    {{-- modal detail reservasi --}}
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

    
    {{-- Modal + pengunjung --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Pengunjung</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('pengunjung.store') }}" method="post">
                    @csrf
                   
                    <div class="form-group mt-1">
                        <input type="text" class="form-control" placeholder="Nama" required min="4" max="25" name="nama">
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Alamat"required min="4" max="25" name="alamat">
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Nomor KTP" required min="4" max="25" name="no_ktp">
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Nomor Telp"required min="4" max="25" name="no_telp">
                    </div>
                   
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button  type="submit" class="btn btn-success">Simpan</button>
    
            </form>
    
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        {{-- Table Pengunjung --}}
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-danger">
                <h6 class="m-0  text-white">Reservasi</h6>
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
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-detail{{$item->id}}">
                                    <i class="fa fa-info" aria-hidden="true"></i> Detail
                                </button>&nbsp;&nbsp;
                                @if($item->status_pay)
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="checkout({{$item}})">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Checkout
                                </button>
                                @else
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="deletee({{$item}})">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                </button>
                                @endif
                                
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
                        <h6 class="m-0  text-white d-flex align-items-center justify-content-between">
                            Pengunjung
                            <button class="btn btn-sm btn-outline-light px-3 rounded-4" data-bs-toggle="modal" title="Tambah Data Pengunjung" data-bs-target="#exampleModal">
                                <i class="fa fa-plus"></i>
                                Pengunjung
                            </button>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            {{-- <div class="col-3">
                                <p class="m-0 ">NIK</p>
                            </div> --}}
                            {{-- <div class="col"> --}}
                            <input onkeyup="searchCust(this)" type="number" class="form-control" name="nama_costumer" id="nama_costumer" placeholder="Masaukna NIK Pengunjung" autofocus>
                            {{-- </div> --}}
                        </div>
                        {{-- <hr> --}}
                        {{-- <div class="row"> --}}
                            {{-- <div class="col-3">
                                <p>Nama Customer</p>
                            </div> --}}
                            <div id="customers">
                            </div>
                            {{-- <form action="">
                                <div class="form-group">
                                  <input type="submit" name="" id="" class="btn btn-success" value="Pesan" aria-describedby="helpId">
                                  <input type="submit" name="" id="" class="btn btn-secondary" value="reset" aria-describedby="helpId">
                                </div>
                            </form> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            {{-- tipe kamar --}}
            <div class="col">
                <div class="card border-0 shadow-lg text-center">
                    <div class="card-header bg-danger">
                        <h6 class=" m-0 text-white">Tipe Kamar</h6>
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
        function checkout(item){
            // console.log(item.tbl_kamar.kode_ruangan);
            Swal.fire({
                title: `Chekcout ${item.tbl_kamar.kode_ruangan} ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Checkout'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/reservasi/checkout",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{ resId : item.id , kamarId : item.tbl_kamar.id },
                        success: function(res){
                            if(res.success){
                                Swal.fire(
                                    'Checkouted!',
                                    res.message,
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload()
                                    } 
                                })
                                console.log(res)
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    });
                }
            })
        }

        function deletee(item){
            // console.log(item.tbl_kamar.kode_ruangan);
            Swal.fire({
                title: `Delete ${item.tbl_kamar.kode_ruangan} ?`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/reservasi/"+item.id,
                        type: "POST",
                        // headers: {
                        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        // },
                        data:{ 
                            _token : $('meta[name=csrf-token]').attr("content"),
                            _method : 'DELETE',
                            kamarId : item.tbl_kamar.id
                        },
                        success: function(res){
                            if(res.success){
                                Swal.fire(
                                    'Deleted',
                                    res.message,
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload()
                                    } 
                                })
                            }
                            console.log(res)
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    });
                }
            })
        }

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
