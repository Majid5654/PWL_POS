@empty($transaksiDetail)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/transaksi') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="#" id="form-edit">
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show Transaksi Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Detail ID</label>
                    <input value="{{ $transaksiDetail->detail_id }}" type="number" name="detail_id" id="detail_id" class="form-control" disabled>
                    <small id="error-detail_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Penjualan ID</label>
                    <input value="{{ $transaksiDetail->penjualan_id }}" type="text" name="penjualan_id" id="penjualan_id" class="form-control" disabled>
                    <small id="error-penjualan_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Barang ID</label>
                    <input value="{{ $transaksiDetail->barang_id }}" type="text" name="barang_id" id="barang_id" class="form-control" disabled>
                    <small id="error-barang_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input value="{{ $transaksiDetail->harga }}" type="number" step="0.01" name="harga" id="harga" class="form-control" disabled>
                    <small id="error-harga" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input value="{{ $transaksiDetail->jumlah }}" type="number" name="jumlah" id="jumlah" class="form-control" disabled>
                    <small id="error-jumlah" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-edit").validate({
            rules: {
                detail_id: {
                    required: true,
                    number: true
                },
                penjualan_id: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                barang_id: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                harga: {
                    required: true,
                    number: true,
                    min: 0
                },
                jumlah: {
                    required: true,
                    number: true,
                    min: 1
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataTransaksi.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
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
@endempty
