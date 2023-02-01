@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header ">
                        <h4 class="m-0 fw-bold">Reservasi</h4>
                    </div>
                    <div class="card-body ">
                        <table class="table table-borderless table-hover text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipe kamar</th>
                                    <th>Kode Koding</th>
                                    <th>Tanggal Booking</th>
                                    <th>Malam</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>King Size</td>
                                    <td>80192</td>
                                    <td>11 January 2222</td>
                                    <td>1 Malam</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-outline-secondary">Print</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-lg text-center">
                    <div class="card-header">
                        <h4 class="m-0 fw-bold">Status Kamar</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Ruang</th>
                                    <th>Tipe Ruangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>11122</td>
                                    <td>King Size</td>
                                    <td>Booked</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header">
                        <h4 class="m-0 fw-bold">Cart</h4>
                    </div>
                    <div class="card-body">
                        {{-- nama costumer --}}
                        <div class="row">
                            <div class="col-4">
                                <p>Nama Costumer</p>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_costumer" id="nama_costumer">
                            </div>
                        </div>

                        {{-- nik --}}
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <p>NIK</p>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_costumer" id="nama_costumer">
                            </div>
                        </div>

                        {{-- Tipe Kamar --}}
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <p>Tipe Kamar</p>
                            </div>
                            <div class="col">
                                <select name="tipe_kamar" id="tipe_kamar" class="form-select">
                                    <option value="">King Bedroom</option>
                                    <option value="">Double Bedroom</option>
                                </select>
                            </div>
                            <form action="">
                                <div class="form-group">
                                  <input type="submit" name="" id="" class="btn btn-success" value="Pesan" aria-describedby="helpId">
                                  <input type="submit" name="" id="" class="btn btn-secondary" value="reset" aria-describedby="helpId">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-lg text-center">
                    <div class="card-header">
                        <h4 class="fw-bold m-0">Tipe Kamar</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tipe</th>
                                    <th>Harga</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Luxury room</td>
                                    <td>Rp. 768.000</td>
                                    <td>
                                        <button class="btn btn-outline-danger rounded-circle"><b>+</b></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
