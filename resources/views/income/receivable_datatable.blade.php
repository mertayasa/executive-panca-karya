<table class="table table-hover table-bordered" width="100%" id="incomeReceivable">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Pendapatan</th>
            <th>Tanggal </th>
            <th>Total Piutang</th>
            <th>Sudah Dibayar</th>
            <th>Sisa</th>
            <th>Keterangan</th>
            <th>Aksi</th>
            <th></th>
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

        table_receivable = $('#incomeReceivable').DataTable({
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
                    data: 'account_receivable.pay',
                    name: 'account_receivable.pay'
                },
                {
                    data: 'account_receivable.remaining_receive',
                    name: 'account_receivable.remaining_receive'
                },
                {
                    data: 'ket',
                    name: 'ket'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    searchable: false,
                    visible: false,
                }
            ],
            order: [
                [9, "desc"]
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
