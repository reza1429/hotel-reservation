{{-- Modal Dialog Create Tipe Kamar --}}
<div class="modal fade" id="tipe-kamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="staticBackdropLabel">Form Tipe Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tipe.store') }}" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nama_tipe" id="nama_tipe">
                        <label for="nama_tipe">Nama Tipe</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" name="harga" id="harga">
                        <label for="harga">Harga</label>
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