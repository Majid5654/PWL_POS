@extends('layout.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title ?? 'Default Title' }}</h3>
            <div class="card-tools">
                <button onclick="modalImport('{{ url('barang/import') }}')" class="btn btn-info">Import Goods</button>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
                <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Barang (XLSX)</a>
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file
                    pdf"></i> Export Barang PDF</a> 
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row col-md-12 form-group row">
                <label class="col-1 control-label col-form-label">Filter</label>
                <div class="col-3">
                    <select class="form-control" name="kategori_id" id="kategori_id">
                        <option value="">- Semua -</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Kategori Barang</small>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <!-- Modal Import Barang -->
<div id="modalImportBarang" class="modal fade animate bounce" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" data-width="50%" aria-hidden="true"></div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show')
            });
        }
        function modalImport(url = '') {
    $('#modalImportBarang').load(url, function () {
        $('#modalImportBarang').modal('show');
    });
}


        var dataBarang;
        $(document).ready(function () {
            dataBarang = $('#table_barang').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('barang/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kategori_id",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "barang_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "harga_beli",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "harga_jual",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#kategori_id').on('change', function () {
                dataBarang.ajax.reload();
            });
        });
    </script>
@endpush