@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col">
            <a href="" class="btn btn-outline-danger">kembali</a>
        </div> --}}
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header bg-danger text-light fw-bold">Tabel Pengunjung</div>
                {{-- cari --}}
        
            
                <div class="card-body">
                    <form action="{{ route('pengunjung.cari') }}"  method="GET">
                    <div class="d-flex align-items-center">
      
                    <div class="input-group" style="width:85%">
                        <input type="text" class="form-control " placeholder="Masukan : Nama / NIK  [ENTER]"  name="nama">
                        <button class="btn  btn-success" type="submit" title="Cari"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <a href="/pengunjung"class="btn btn-warning text-light me-1" title="Refresh Page"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    </div>
                    <div class="mx-2 d-inline-flex">

                        <button class="btn btn-primary "  data-bs-toggle="modal" title="Tambah Data Pengunjung" data-bs-target="#exampleModal" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Pengunjung</button>
                    </div>
                      </div>
                      
                </div>
                      
                    </form>

                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                        <div class="table-responsive-md">
                    <table class="table table-stripped  border" >
                        <thead class="thead-light text-center fw-bold">
                            <td style="width: 5%">#</td>
                            <td style="width: 20%">Nama</td>
                            <td style="width: 35%">Alamat</td>
                            <td style="width: 10%">NoKTP</td>
                            <td style="width: 10%">NoTelp</td>
                            <td  style="width: 20%">Action</td>
                        </thead>
                        <tbody>
                            @foreach ($pengunjungs as $i => $item)
                                
                            <tr>
                             <td class="text-center" >{{ $pengunjungs->firstItem()+$i }}.</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_ktp }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td  class="text-center">
                                <form action="{{ route('pengunjung.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                <a href="{{ route('pengunjung.edit', $item->id)}}" class="btn btn-sm btn-warning" title="Edit Pengunjung"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                
                                <button type="submit" class="btn btn btn-sm btn-danger" ><i class="fa fa-trash"title="Hapus Pengunjung" aria-hidden="true"></i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                        
                    </table>
                </div>
                <div class="container">
                <p class="mb-3 h6 text-dark ">Menampilkan {{ $pengunjungs->firstItem() }} - {{ $pengunjungs->lastItem()  }} data dari total  {{ $pengunjungs->total() }} data</p>
                    {{$pengunjungs->links()}}
                </div>


                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
           
        </div> --}}
    </div>
</div>

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
@endsection

