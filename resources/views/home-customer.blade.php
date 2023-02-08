@foreach ($pengunjung as $md)
<div class="modal modal-lg fade" id="exampleModal-{{$md->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Reservation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Customer Name</label>
                <input value="{{$md->nama}}" type="text" class="form-control" id="nama" aria-describedby="emailHelp" readonly>
            </div>
            <div class="input-group mb-3">
                
                <span class="input-group-text">Type Kamar</span>
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                {{-- <input type="text" class="form-control" placeholder="Username" aria-label="Username"> --}}
                <span class="input-group-text">No kamar</span>
                <select class="form-select" id="inputGroupSelect01" disabled>
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                {{-- <input type="text" class="form-control" placeholder="Server" aria-label="Server"> --}}
            </div>
            <div class="input-group">
                <input type="number" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="Lama Sewa">
                <span class="input-group-text">Malam</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
