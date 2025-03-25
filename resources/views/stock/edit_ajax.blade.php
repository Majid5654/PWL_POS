@extends('layout.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Stok Barang</h3>
        </div>

        <div class="card-body">
            <form id="form_update_stok" action="{{ route('stok.update', $stok->stok_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control" name="barang_id" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->barang_id }}" {{ $b->barang_id == $stok->barang_id ? 'selected' : '' }}>
                                {{ $b->barang_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" name="stok_jumlah" value="{{ $stok->stok_jumlah }}" required>
                </div>

                <div class="form-group">
                    <label>Pengguna</label>
                    <select class="form-control" name="user_id" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $u->id == $stok->user_id ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#form_update_stok').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        $('#myModal').modal('hide');
                        $('#table_stok').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });
        });
    </script>
@endsection
