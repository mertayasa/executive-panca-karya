<table class="table table-hover table-bordered" width="100%" id="incomeReceivable">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Jenis Pendapatan</th>
            <th>Tanggal </th>
            <th>Total Piutang</th>
            <th>Sudah Dibayar</th>
            <th>Sisa</th>
            <th>Penerima</th>
            <th>Keterangan</th>
            <th></th>
            @if (getRoleName() == 'staff')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table_receivable
    let url_receivable = "{{ route('income.datatable_receivable') }}"

    datatableReceivable(url_receivable)

    function datatableReceivable(url) {

        let responsivePriorityRec = 4

        let columnsRec = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'customer.name',
                name: 'customer.name'
            },
            {
                data: 'income_type.name',
                name: 'income_type.name'
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
                data: 'paid',
                name: 'paid'
            },
            {
                data: 'receivable_remain',
                name: 'receivable_remain'
            },
            {
                data: 'receiver_name',
                name: 'receiver_name'
            },
            {
                data: 'ket',
                name: 'ket'
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                visible: false,
            }
        ]

        @if(getRoleName() == 'staff')
            responsivePriority = 9
            columnsRec.push({
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                })
        @endif

        table_receivable = $('#incomeReceivable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columnsRec,
            order: [
                [8, "desc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 8
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
