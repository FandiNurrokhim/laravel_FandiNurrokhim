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
        getData()
    });

    $('.btn-get-data').click(function() {
        getData()
    })

    function getData() {

        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        dataTableObj.clear().draw();

        var filter_nama = $('#filter_nama').val() || '';
        var filter_alamat = $('#filter_alamat').val() || '';
        var filter_email = $('#filter_email').val() || '';
        var filter_telepon = $('#filter_telepon').val() || '';

        $.ajax({
            url: '{{ url('rumah-sakit/search') }}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: {
                nama: filter_nama,
                alamat: filter_alamat,
                email: filter_email,
                telepon: filter_telepon
            },
            success: function(results) {
                var data = results.data;

                $.each(data, function(index, item) {
                    var array_temp = [];
                    array_temp.push(item.nama);
                    array_temp.push(item.alamat);
                    array_temp.push(item.email);
                    array_temp.push(item.telepon);
                    array_temp.push(item.jumlah_pasien);

                    var html = `<a href="{{ url('rumah-sakit/view/') }}/` + item.id + `" class="btn btn-primary btn-sm">View</a>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="` + item.id + `">Delete</button>`;
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
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '{{ url('rumah_sakit/delete') }}/' + id,
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
    }
</script>
