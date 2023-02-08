{{-- Modal Dialog Create Tipe Kamar --}}
<div class="modal fade" id="kamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="staticBackdropLabel">Form Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kamar.store') }}" method="post">
                    @csrf
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
                            <input class="form-check-input" type="radio" name="status" id="status1" value="0" checked>
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