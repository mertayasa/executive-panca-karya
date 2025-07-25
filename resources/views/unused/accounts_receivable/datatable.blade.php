<table class="table table-hover table-striped" width="100%" id="expenseDatatable">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Pelanggan</th>
        <th>Jenis Pendapatan</th>
        <th>Tanggal</th>
        <th>Jumlah Piutang</th>
        <th>Bayar</th>
        <th>Sisa</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>

    let table
    let url = "{{ route('accounts_receivable.datatable') }}"

    datatable(url)
    function datatable (url){

        table = $('#expenseDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
                {data: 'que', name: 'que'},
                {data: 'patient.name', name: 'patient.name'},
                {data: 'date', name: 'date'},
                {data: 'keterangan', name: 'keterangan', orderable:false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[ 1, "desc" ]],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets:  '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1, targets: 1
                },
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari"
            },
        });
    }

</script>

@endpush
