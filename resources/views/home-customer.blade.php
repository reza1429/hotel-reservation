@forelse ($pengunjung as $item)
<p id="customer-search" class="bg-danger rounded-1 p-2 text-white fs-5 mb-2">
    </span class="fw-bold " style="letter-spacing: 2px"> 
        {{$item->no_ktp}} 
    <span>
    a/n {{$item->nama}}
    <a href="/create/reservation/{{$item->id}}" class="float-end btn btn-sm btn-light fw-bold ">Pesan!!</a>
</p>
@empty
<P>Pelanggan tidak tersedia</P>
@endforelse
