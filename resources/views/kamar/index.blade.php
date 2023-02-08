@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-2">
            <div class="card border-0 shadow">
                <div class="card-header bg-danger fs-4 fw-bold text-light">Daftar Tipe Kamar 
                    <button type="button" class="btn btn-dark rounded d-inline float-end" data-bs-toggle="modal" data-bs-target="#tipe-kamar">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tipe
                    </button>
                </div>
                
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                    @endif
                    <table class="table table-responsive table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tipe</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipe_kamars as $tipe)
                                
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tipe->nama_tipe }}</td>
                                <td>Rp. {{ number_format($tipe->harga) }}</td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-success" data-bs-toggle="modal">Edit</a> --}}
                                    <form class="d-inline" action="{{ route('tipe.destroy', $tipe->id) }}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Yakin ingin menghapus?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow">
                <div class="card-header bg-danger fs-4 fw-bold text-light">Daftar Kamar
                    <button id="tkamar" type="button" class="btn btn-dark rounded d-inline float-end" data-bs-toggle="modal" data-bs-target="#kamar">
                        <i class="fa fa-plus" aria-hidden="true"></i> Kamar
                    </button>
                </div>
                <div class="card-body">
                    @if (session()->has('succes'))
                        <div class="alert alert-success alert-dismissible fade show ms-auto" role="alert">
                            {{session('succes')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                    @endif
                    <table class="table table-borderless table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ruangan</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamars as $kamar)
                                
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kamar->kode_ruangan }}</td>
                                <td>{{ $kamar->tipe_kamar->nama_tipe }}</td>
                                <td>{{ $kamar->status }}</td>
                                <td>
                                    {{-- <a class="btn btn-warning" href="/kamar/{{ $kamar->id }}"></a> --}}
                                    <button class="btn btn-sm btn-warning btn-detail open_modal" value="{{$kamar->id}}"><i class="fa fa-edit" aria-hidden="true"></i></button>

                                    <form class="d-inline" action="{{ route('kamar.destroy', $kamar->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Yakin ingin menghapus?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $kamars->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@include('kamar.form_kamar')
@include('kamar.form_tipe')

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary fs-4 fw-bold text-light">
                <h4 class="modal-title" id="myModalLabel">Edit</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="editform">
                    @csrf
                    @method('put')
                    <input type="hidden" name="kamar_id">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="kode_ruangan" id="kode_ruangan" required autofocus>
                        <label for="kode_ruangan">Kode Ruangan</label>
                    </div>
                    <div class="form-floating mt-2">
                        <select class="form-select" id="tipe_id" name="tipe_id" required>
                            <option selected value="" disabled>Pilih Tipe</option>
                            @foreach ($tipe_kamars as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama_tipe }}</option>
                            @endforeach
                          </select>
                          <label for="tipe_id">Tipe Kamar</label>
                    </div>
                    <div class="form-control mt-2">
                        <div class="form-check mt-2">
                            <input checked class="form-check-input" type="radio" name="status" id="status" value="0">
                            <label class="form-check-label" for="status1">
                              Tersedia
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status2" value="1">
                            <label class="form-check-label" for="status2">
                              Tidak tersedia
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>



    $(document).on('click','.open_modal',function(){
        var url = "/kamar";
        var kamar_id = $(this).val();
        $.get(url + '/' + kamar_id , function (data) {
            //success data
            const target = "{{ url('kamar/:id') }}".replace(':id', data.id)
            $('input#kamar_id').val(data.id);
            $('input#kode_ruangan').val(data.kode_ruangan);
            $('select#tipe_id').val(data.tipe_id).change();
            if(data.status == '0'){
                $('input#status').prop('checked', true);
            } else{
                $('input#status2').prop('checked', true);
            };
            $('#editform').attr('action', target);
            $('#myModal').modal('show');
        }) 
    });
    $(document).on('click','#tkamar',function(){
            $('input#kode_ruangan').val("");
            $('select#tipe_id')[0].selectedIndex = 0;
            $('input#status1').prop('checked', true);
        });
</script>
@endsection