@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('pasien')}}" class="btn btn-secondary">Kembali ke Daftar Pasien</a>
            </div>
            <div class="card">

                @if($method == 'new')
                <div class="card-header">Buat Pasien Baru</div>
                @else
                <div class="card-header">Edit Pasien</div>
                @endif

                <div class="card-body">
                    @include('pasien.form.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection