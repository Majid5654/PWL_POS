<form id="form_stok" action="{{ route('stok.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Nama Barang</label>
        <select class="form-control" name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barang as $b)
                <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
            @endforeach
        </select>
        <span class="text-danger error-text" id="error-barang_id"></span>
    </div>

    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" class="form-control" name="stok_jumlah" required>
        <span class="text-danger error-text" id="error-stok_jumlah"></span>
    </div>

    <div class="form-group">
        <label>Pengguna</label>
        <select class="form-control" name="user_id" required>
            <option value="">-- Pilih Pengguna --</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->nama }}</option>
            @endforeach
        </select>
        <span class="text-danger error-text" id="error-user_id"></span>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form_stok").on('submit', function(event) {
    event.preventDefault(); // Mencegah default submit (GET)
});

        $("#form_stok").validate({
            rules: {
                barang_id: { required: true },
                stok_jumlah: { required: true, min: 1, number: true },
                user_id: { required: true }
            },
            messages: {
                barang_id: { required: "Pilih barang terlebih dahulu." },
                stok_jumlah: { required: "Masukkan jumlah stok.", min: "Jumlah harus lebih dari 0.", number: "Harus berupa angka." },
                user_id: { required: "Pilih pengguna terlebih dahulu." }
            },
            submitHandler: function(form) {
                let formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            $('#modalStok').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataStok.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.errors, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = "Terjadi kesalahan saat menyimpan data.";
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).flat().join("\n");
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: errorMsg
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
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
