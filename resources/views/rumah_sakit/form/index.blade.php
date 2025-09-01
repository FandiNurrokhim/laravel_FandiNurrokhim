@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('rumah-sakit')}}" class="btn btn-secondary">Kembali ke Daftar Rumah Sakit</a>
            </div>
            <div class="card">

                @if($method == 'new')
                <div class="card-header">Buat Data Rumah Sakit</div>
                @else
                <div class="card-header">Edit Data Rumah Sakit</div>
                @endif

                <div class="card-body">
                    @include('rumah_sakit.form.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection