<table class="table table-hover table-bordered" width="100%" id="incomeReceivable">
    <thead class="text-center">
        <tr>
            <th class="text-center">No</th>
            <th></th>
            <th class="text-center">No Nota</th>
            {{-- <th>Pelanggan</th> --}}
            {{-- <th>Penerima</th> --}}
            <th>Jenis Pendapatan</th>
            <th class="text-center">Tanggal Transaksi</th>
            <th>Total Piutang (Rp)</th>
            {{-- <th>Sudah Dibayar (Rp)</th>
            <th>Sisa (Rp)</th> --}}
            <th>Keterangan</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table_receivable
    let url_receivable = "{{ route('income.datatable_receivable_detail', $customer->id) }}"

    datatableReceivable(url_receivable)

    function datatableReceivable(url) {

        let columnsRec = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false,
                className: "text-center"
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                visible: false,
            },
            {
                data: 'invoice_no',
                name: 'invoice_no',
                className: "text-center"
            },
            // {
            //     data: 'customer.name',
            //     name: 'customer.name'
            // },
            // {
            //     data: 'receiver_name',
            //     name: 'receiver_name'
            // },
            {
                data: 'income_type.name',
                name: 'income_type.name'
            },
            {
                data: 'date',
                name: 'date',
                orderable: false,
                className: "text-center"
            },
            {
                data: 'total',
                name: 'total',
                orderable: false,
                className: "text-right"
            },
            // {
            //     data: 'paid',
            //     name: 'paid',
            //     className: "text-right"
            // },
            // {
            //     data: 'receivable_remain',
            //     name: 'receivable_remain',
            //     className: "text-right"
            // },
            {
                data: 'ket',
                name: 'ket'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: "text-center"
            }
        ]

        table_receivable = $('#incomeReceivable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columnsRec,
            // order: [
            //     [8, "desc"]
            // ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 7
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
