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
    action="{{ $method == 'edit' ? route('pasien.update', $item->id) : route('pasien.store') }}">
    @csrf
    @if ($method == 'edit')
        @method('PUT')
    @endif

    <div class="form-group">
        <label>Nama Pasien</label>
        <input type="text" class="form-control" name="nama" required value="{{ $item->nama ?? '' }}">
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" required value="{{ $item->alamat ?? '' }}">
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" class="form-control" name="no_telepon" required value="{{ $item->no_telepon ?? '' }}">
    </div>

    <div class="form-group">
        <label>Rumah Sakit</label>
        <select class="form-control" name="rumah_sakit_id" required>
            <option value="">--Pilih Rumah Sakit--</option>
            @foreach ($rumahSakits as $rs)
                <option value="{{ $rs->id }}" @if(isset($item) && $item->rumah_sakit_id == $rs->id) selected @endif>
                    {{ $rs->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary mt-3">Submit</button>
</form>