<div class="modal-header">
    <h5 class="modal-title">Tambah Level</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form id="form_level" action="{{ url('level/store_ajax') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode Level</label>
            <input type="text" class="form-control" name="level_kode" required>
        </div>
        <div class="form-group">
            <label>Nama Level</label>
            <input type="text" class="form-control" name="level_nama" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $(document).ready(function () {
        // Fungsi menutup modal saat tombol close atau batal diklik
        $(".btn-close-modal").click(function () {
            $("#modalLevel").modal("hide");
        });



        $('#form_level').submit(function (e) {
            e.preventDefault(); // Mencegah submit bawaan form
            let form = $(this);
            
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        dataLevel.ajax.reload(); // Reload tabel jika pakai DataTables
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data'
                    });
                }
            });
        });
    });
</script>
