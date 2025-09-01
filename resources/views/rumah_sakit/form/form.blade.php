@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
    action="{{ $method == 'edit' ? route('rumah_sakit.update', $item->id) : route('rumah_sakit.store') }}">
    @csrf
    @if ($method == 'edit')
        @method('PUT')
    @endif

    <div class="form-group">
        <label>Nama Rumah Sakit</label>
        <input type="text" class="form-control" name="nama" required value="{{ $item->nama ?? '' }}">
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" required value="{{ $item->alamat ?? '' }}">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required value="{{ $item->email ?? '' }}">
    </div>

    <div class="form-group">
        <label>Telepon</label>
        <input type="text" class="form-control" name="telepon" required value="{{ $item->telepon ?? '' }}">
    </div>

    <button class="btn btn-primary mt-3">Submit</button>
</form>