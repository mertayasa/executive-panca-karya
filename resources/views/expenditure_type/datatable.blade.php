<table class="table table-hover table-striped" width="100%" id="expenseDatatable">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Jenis Pengeluaran</th>
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
    let url = "{{ route('expenditure_type.datatable') }}"

    datatable(url)

    function datatable(url) {

        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'no',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            }
        ]

        @if(getRoleName() == 'staff')
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
                [1, "desc"]
            ],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets: '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1,
                    targets: 1
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
