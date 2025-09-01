<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    var start_date = '';
    var end_date = '';
    var data_per_fetch = 500;
    var data_fetched = 0;

    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [
                [0, 'desc']
            ],
        });
        getData();
    });

    $('.btn-get-data').click(function() {
        getData();
    });

    function getData() {
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        dataTableObj.clear().draw();

        var filter_nama = $('#filter_nama').val() || '';
        var filter_rumah_sakit_id = $('#filter_rumah_sakit_id').val() || '';

        $.ajax({
            url: '{{ url('pasien/search') }}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: {
                nama: filter_nama,
                rumah_sakit_id: filter_rumah_sakit_id
            },
            success: function(results) {
                var data = results.data;
                $.each(data, function(index, item) {
                    var array_temp = [];
                    array_temp.push(item.nama);
                    array_temp.push(item.alamat);
                    array_temp.push(item.no_telepon);
                    array_temp.push(item.rumah_sakit_nama);

                    var html = `<a href="{{ url('pasien/view/') }}/` + item.id + `" class="btn btn-primary">View</a>
                            <button class="btn btn-danger btn-delete" data-id="` + item.id + `">Delete</button>`;
                    array_temp.push(html);

                    dataTableObj.row.add(array_temp).draw(true);
                });
                $('#loading-filter').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data');
                $('#loading-filter').hide();
                return;
            }
        });
    }

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: '{{ url('pasien/delete') }}/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    alert('Data berhasil dihapus');
                    location.reload();
                },
                error: function() {
                    alert('Gagal menghapus data');
                }
            });
        }
    });
</script>
