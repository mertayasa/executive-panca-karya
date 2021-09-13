<table class="table table-hover table-bordered" width="100%" id="expenseDatatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Pengeluaran</th>
            <th>Tanggal </th>
            <th class="text-right">Jumlah Pengeluaran (Rp)</th>
            <th>Nota</th>
            @if(getRoleName() == 'staff')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table
    let url = "{{ route('expenditure.datatable') }}"

    datatable(url)

    function datatable(url) {

        responsivePriority = 3

        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'expenditure_type.name',
                name: 'expenditure_type.name'
            },
            {
                data: 'date',
                name: 'date',
                orderable: false
            },
            {
                data: 'amount',
                name: 'amount',
                orderable: false,
                className: "text-right"
            },
            {
                data: 'note',
                name: 'note'
            }
        ]

        @if(getRoleName() == 'staff')
            responsivePriority = 5
            columns.push({
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                })
        @endif

        table = $('#expenseDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columns,
            order: [
                [2, "desc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: responsivePriority
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
