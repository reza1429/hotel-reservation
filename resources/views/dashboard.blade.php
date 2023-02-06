@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="" class="btn btn-outline-danger">History Transaksi</a>
                    <a href="" class="btn btn-outline-danger">History Transaksi</a>
                    <a href="" class="btn btn-outline-danger">History Transaksi</a>
                    <a href="" class="btn btn-outline-danger">History Transaksi</a>
                </div>
            </div>
            <div class="card shadow-lg p-3 mb-5 bg-body rounded mt-3">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col">
                            <form action="" class="">
                                <div class="input-group mb-3 w-50">
                                    <input type="text" class="form-control" placeholder="NIK / nama customer"
                                        aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-danger" type="button" id="button-addon2">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col text-end">
                            <form action="">
                                <button class="btn btn-outline-warning">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Naama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
