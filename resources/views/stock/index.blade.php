@extends('layout.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Stok Barang</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Tambah Stok
                </button>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        function modalAction(url) {
            $('#myModal .modal-content').html('');
            $('#myModal .modal-content').load(url, function(response, status, xhr) {
                if (status === "error") {
                    alert("Terjadi kesalahan: " + xhr.status + " " + xhr.statusText);
                } else {
                    $('#myModal').modal('show');
                }
            });
        }

        $(document).ready(function() {
            var dataStok = $('#table_stok').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('stok.list') }}",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                },
                columns: [
                    { data: "stok_id", className: "text-center" },
                    { data: "barang_nama", defaultContent: "Data Tidak Ada" },
                    { data: "stok_jumlah" },
                    { data: "user_nama", defaultContent: "Data Tidak Ada" },
                    { 
                        data: "aksi", 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button onclick="modalAction('{{ url('/stok/edit') }}/${row.stok_id}')" class="btn btn-sm btn-warning">Edit</button>
                                <button onclick="hapusData(${row.stok_id})" class="btn btn-sm btn-danger">Hapus</button>
                            `;
                        }
                    }
                ]
            });

            $(document).on('submit', '#form_stok', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Data berhasil disimpan!");
                        $('#myModal').modal('hide');
                        dataStok.ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });
        });

        function hapusData(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: '{{ url("/stok/destroy") }}/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function(response) {
                        alert(response.message);
                        $('#table_stok').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
        }
    </script>
@endpush
