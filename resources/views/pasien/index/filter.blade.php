<div id="filter-container">
    <h4>Filter</h4>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Nama Pasien</label>
                <input type="text" class="form-control" id="filter_nama">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Rumah Sakit</label>
                <select class="form-control" id="filter_rumah_sakit_id">
                    <option value="">-- Semua Rumah Sakit --</option>
                    @foreach ($rumahSakits as $rs)
                        <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mt-1 btn-get-data">Filter</button>
    <span id="loading-filter" style="display: none;">Loading...</span>
</div>