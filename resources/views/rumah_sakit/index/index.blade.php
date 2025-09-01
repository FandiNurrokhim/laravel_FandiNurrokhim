@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-group mb-2">
                    <a href="{{ url('rumah-sakit/form/new') }}" class="btn btn-secondary">+ Rumah Sakit Baru</a>
                </div>
                <div class="card">
                    <div class="card-header">Daftar Rumah Sakit</div>

                    <div class="card-body">
                        @include('rumah_sakit.index.filter')
                        @include('rumah_sakit.index.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('rumah_sakit.index.js')
@endsection
