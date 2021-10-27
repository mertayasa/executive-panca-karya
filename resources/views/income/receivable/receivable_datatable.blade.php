@if (isset($receiavable_count))
    <h5 class="mb-3">Total Piutang : {{$receiavable_count}}</h5>
@endif

<table class="table table-hover table-bordered" width="100%" id="incomeReceivable">
    <thead>
        <tr>
            {{-- <th>Jenis Pendapatan</th> --}}
            {{-- <th>Penerima</th> --}}
            {{-- <th>Keterangan</th> --}}
            {{-- <th>Tanggal </th> --}}

            <th>No</th>
            <th></th>
            <th>Pelanggan</th>
            {{-- <th>Tanggal </th> --}}

            {{-- <th>Total Piutang</th>
            <th>Sudah Dibayar</th> --}}
            <th class="text-right align-middle">Sisa Piutang (Rp)</th>
            <th></th>
            <th>Aksi</th>
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
        let columnsRec = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                visible: false,
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'total_receivable',
                name: 'total_receivable',
                className: "text-right"
                // orderable: false
            },
            {
                data: 'raw_total_receivable',
                name: 'raw_total_receivable',
                visible: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]

        table_receivable = $('#incomeReceivable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: columnsRec,
            order: [
                [4, "asc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 4
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
