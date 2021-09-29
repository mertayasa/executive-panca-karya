<table class="table table-hover table-bordered" width="100%" id="incomeReceivable">
    <thead>
        <tr>
            {{-- <th>Jenis Pendapatan</th> --}}
            {{-- <th>Penerima</th> --}}
            {{-- <th>Keterangan</th> --}}
            {{-- <th>Tanggal </th> --}}

            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal </th>

            {{-- <th>Total Piutang</th>
            <th>Sudah Dibayar</th> --}}
            <th class="text-right">Sisa Piutang (Rp)</th>
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

        let responsivePriorityRec = 2

        let columnsRec = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
              {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'total_receivable',
                name: 'total_receivable',
                className: "text-right"
                // orderable: false
            },
            // {
            //     data: 'total_receivable',
            //     name: 'total_receivable'
            // },
            // {
            //     data: 'total_receivable',
            //     name: 'total_receivable'
            // },
            {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                visible: false,
            }
        ]

        @if(getRoleName() == 'staff')
            responsivePriorityRec = 3
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
                [3, "asc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: responsivePriorityRec
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
