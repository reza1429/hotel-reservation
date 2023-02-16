@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col">
            <a href="" class="btn btn-outline-danger">kembali</a>
        </div> --}}
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header bg-danger text-light fw-bold">Tagihan Pembayaran</div>
                {{-- cari --}}
        
            
                <div class="card-body">
                    <form action="{{ route('pembayaran.cari') }}"  method="GET">
                    <div class="d-flex align-items-center">
      
                    <div class="input-group" style="width:100%">
                        <input type="text" class="form-control " placeholder="Masukan : Kode Pembayaran  [ENTER]"  name="kode_bayar" value="{{ $hasilCari }}">
                        <button class="btn  btn-success" type="submit" title="Cari"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <a href="/pembayaran"class="btn btn-warning text-light me-1" title="Refresh Page"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    </div>
                    <div class="mx-2 d-inline-flex">

                        {{-- <button class="btn btn-primary "  data-bs-toggle="modal" title="Tambah Data Pengunjung" data-bs-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Pengunjung</button> --}}
                    </div>
                      </div>
                      
                </div>
                      
                    </form>

                    
                    @if (session('status'))
                    <div class="container">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        </div>
                    @endif
                   
                    {{-- {{ __('You are logged in!') }} --}}
                        <div class="table-responsive-md">
                    <table class="table table-stripped  border" >
                        <thead class="thead-light text-center fw-bold">
                            <td >#</td>
                            <td >Kode Pembayaran</td>
                            <td>Total Harga</td>
                            {{-- <td>Uang Bayar</td> --}}
                            <td>Action</td>
                            
                        </thead>
                        <tbody class="text-center">
                            @if($pembayarans->isEmpty())
                            <tr><td colspan="6" class="text-center fw-bold"><h6>Tidak Ada Data yang Ditemukan</h6></td></tr>
                            @else
                            @foreach ($pembayarans as $i => $item)
                                
                            <tr>
                             <td >{{ $pembayarans->firstItem()+$i }}.</td>
                            <td>{{$item->kode_bayar}}</td>
                            <td>{{number_format($item->total_harga)}}</td>
                            {{-- <td>{{$item->uang_bayar}}</td> --}}
                            <td  class="text-center">                                    
                                <a href="{{ route('pembayaran.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Pengunjung"><i class="fa fa-edit" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        @endforeach
                       @endif
                        </tbody>
                        
                    </table>
                </div>
                <div class="container">
                <p class="mb-3 h6 text-dark ">Menampilkan {{ $pembayarans->firstItem() }} - {{ $pembayarans->lastItem()  }} data dari total  {{ $pembayarans->total() }} data</p>
                    {{$pembayarans->links()}}
                </div>


                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
           
        </div> --}}
    </div>
</div>


</div>
@endsection

