<table class="table table-hover table-bordered" width="100%" id="incomeDatatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Jenis Pendapatan</th>
            <th>Tanggal </th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Aksi</th>
            <th></th>
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

        table = $('#incomeDatatable').DataTable({
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
                [7, "desc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 6
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
