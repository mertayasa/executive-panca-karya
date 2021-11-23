<table class="table table-hover table-bordered " width="100%" id="incomeDatatable">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th></th>
            <th class="text-center">No Nota </th>
            <th>Tanggal Transaksi</th>
            <th>Pelanggan</th>
            <th>Jenis Pendapatan</th>
            <th class="text-right align-middle">Total (Rp)</th>
            {{-- <th>Penerima</th> --}}
            {{-- <th>Keterangan</th> --}}
             <th class="text-center">Tgl Pelunasan</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table
    let url = "{{ route('income.datatable') }}"

    datatable(url)

    function datatable(url) {

        let columns = [
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
            {
                data: 'date',
                name: 'date',
                orderable: false,
                className: "text-center"
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
                data: 'total',
                name: 'total',
                orderable: false,
                className: "text-right"
            },
              {
                data: 'paid_date',
                name: 'paid_date',
                className: "text-center"
            },
            //   {
            //     data: 'status',
            //     name: 'status'
            // },
            // {
            //     data: 'receiver_name',
            //     name: 'receiver_name'
            // },
            // {
            //     data: 'ket',
            //     name: 'ket'
            // },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: "text-center"
            }
        ]

        table = $('#incomeDatatable').DataTable({
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
