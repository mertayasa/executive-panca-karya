<table class="table table-hover table-bordered" width="100%" id="incomeReportDatatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Jenis Pendapatan</th>
            <th>Tanggal </th>
            <th>Total</th>
            <th>Keterangan</th>
            <th></th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table
    let url = "{{ route('income_report.datatable') }}"

    datatable(url)

    function datatable(url) {

        table = $('#incomeReportDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'no',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'customer.name',
                    name: 'customer.name',
                    orderable: false
                },
                {
                    data: 'income_type.name',
                    name: 'income_type.name',
                    orderable: false
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false
                },
                {
                    data: 'total',
                    name: 'total',
                    orderable: false
                },
                {
                    data: 'ket',
                    name: 'ket',
                    orderable: false
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    searchable: false,
                    visible: false,
                }
            ],
            order: [
                [6, "desc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 5
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
