@foreach ($pengunjung as $md)
<div class="modal modal-lg fade" id="exampleModal-{{$md->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Reservation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- <div class="mb-3">
                <label for="nama" class="form-label">Customer Name</label>
            </div> --}}
            <input value="{{$md->id}}" type="hidden" class="form-control" id="nama" name="namaPengunjung" aria-describedby="nama" readonly>
            <div class="input-group mb-3">
                
                <span class="input-group-text">Type Kamar</span>
                <select class="form-select" id="inputGroupType" onchange="roomtype()">
                    <option selected>Choose...</option>
                    @foreach ($tipes as $tipe)
                        <option value="{{$tipe->id}}" name="tipeKamar">{{$tipe->nama_tipe}}</option>
                    @endforeach
                </select>
                {{-- <input type="text" class="form-control" placeholder="Username" aria-label="Username"> --}}
                <span class="input-group-text">No kamar</span>
                <select class="form-select" id="inputGroupSelectNokamar" disabled>
                </select>
                {{-- <input type="text" class="form-control" placeholder="Server" aria-label="Server"> --}}
            </div>
            <div class="input-group">
                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Lama Sewa" name="lamaSewa" id="lamaSewa">
                <span class="input-group-text">Malam</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="svReservasi('exampleModal-{{$md->id}}')">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endforeach
@forelse ($pengunjung as $item)
<p id="customer-search" class="bg-danger rounded-1 p-2 text-white fs-5 mb-2">
    </span class="fw-bold " style="letter-spacing: 2px"> 
        {{$item->no_ktp}} 
    <span>
    a/n {{$item->nama}}
    
    <!-- Button trigger modal -->
<button type="button" class="float-end btn btn-sm btn-light fw-bold " data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
    Launch demo modal
  </button>
    {{-- <a href="/create/reservation/{{$item->id}}" class="float-end btn btn-sm btn-light fw-bold ">Pesan!!</a> --}}
</p>
@empty
<P>Pelanggan tidak tersedia</P>
@endforelse

    

<script>
    function svReservasi(mdId){
        let nama = $('#nama').val()
        // let tipeKamar = $('#inputGroupType').val()
        let noKamar = $('#inputGroupSelectNokamar').val()
        let durasi = $('#lamaSewa').val()
        let modalId = $(`#${mdId}`)
        
        $.ajax({
            url: "/reservasi",
            type:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{ nama, noKamar, durasi},
            success: function(res){
                if(res.success){
                    modalId.modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        timer: 4000
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(location).prop('href', 'http://127.0.0.1:8000/home')
                        } 
                    })
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
    function roomtype(){
        // alert(true)
        $('#inputGroupSelectNokamar').prop('disabled', false);
        let val = $('#inputGroupType').val()
        // console.log(val)
        $.ajax({
            url: "/reservasi",
            type:"GET",
            data:{ val },
            success: function(res){
                let _html = []
                res.forEach(kamar => {
                    _html.push(`<option value="${kamar.id}" name="noKamar">${kamar.kode_ruangan}</option>`)
                });
                $('#inputGroupSelectNokamar').html(_html)
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
</script>