@extends('layout.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Level</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/level/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Tambah Ajax
                </button>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="table_level">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Level</th>
                        <th>Nama Level</th>
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
            var dataLevel = $('#table_level').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('level/list') }}",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                },
                columns: [
                    { data: "level_id", className: "text-center" }, 
                    { data: "level_kode" },
                    { data: "level_nama" },
                    { data: "aksi", orderable: false, searchable: false }
                ]
            });

            $(document).on('submit', '#form_level', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Data berhasil disimpan!");
                        $('#myModal').modal('hide');
                        dataLevel.ajax.reload();
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });
        });
    </script>
@endpush
