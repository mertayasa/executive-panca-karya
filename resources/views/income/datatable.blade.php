<table class="table table-hover table-bordered" width="100%" id="incomeDatatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal </th>
            <th>Pelanggan</th>
            <th>Jenis Pendapatan</th>
            <th class="text-right">Total (Rp)</th>
            {{-- <th>Penerima</th> --}}
            {{-- <th>Keterangan</th> --}}
             <th>Pembayaran</th>
            <th></th>
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
    let url = "{{ route('income.datatable') }}"

    datatable(url)

    function datatable(url) {

        let responsivePriority = 3
        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
                {
                data: 'date',
                name: 'date',
                orderable: false
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
                data: 'status',
                name: 'status'
            },
            // {
            //     data: 'receiver_name',
            //     name: 'receiver_name'
            // },
            // {
            //     data: 'ket',
            //     name: 'ket'
            // },
            {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                visible: false,
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

        table = $('#incomeDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columns,
            // order: [
            //     [2, "desc"]
            // ],
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
