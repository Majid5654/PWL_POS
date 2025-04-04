<form action="{{ url('/user/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Level Pengguna</label>
                    <select name="level_id" id="level_id" class="form-control" required>
    <option value="">- Pilih Level -</option>
    <?php foreach ($level as $l): ?>
        <option value="<?= $l->level_id ?>"><?= $l->level_nama ?></option>
    <?php endforeach; ?>
</select>



                    <small id="error-level_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input value="" type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input value="" type="password" name="password" id="password" class="form-
    control"
                        required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
   $(document).ready(function() {
    $("#form-tambah").validate({
        rules: {
            level_id: {
                required: true,
                number: true
            },
            username: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            nama: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide'); // Menutup modal jika digunakan
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.href = response.redirect; // Redirect ke halaman user
                        });

                        dataUser.ajax.reload(); // Reload data tabel (jika menggunakan DataTables)
                    } else {
                        $('.error-text').text(''); // Hapus pesan error sebelumnya
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]); // Menampilkan error di bawah input
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Terjadi kesalahan:", xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Server',
                        text: 'Terjadi kesalahan pada server, silakan coba lagi.'
                    });
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});

</script>