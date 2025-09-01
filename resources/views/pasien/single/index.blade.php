@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group mb-2">
                    <a href="{{ url('pasien') }}" class="btn btn-secondary">Kembali ke Daftar Pasien</a>
                </div>
                <div class="card">
                    <div class="card-header">Detail Pasien</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{ $data->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>:</td>
                                <td>{{ $data->no_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Rumah Sakit</th>
                                <td>:</td>
                                <td>{{ $data->rumahSakit->nama ?? '-' }}</td>
                            </tr>
                        </table>
                        <a class="btn btn-info" href="{{ url('pasien/form/edit') }}/{{ $data->id }}">Edit</a>
                        <button class="btn btn-danger btn-delete" data-id="{{ $data->id }}">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection