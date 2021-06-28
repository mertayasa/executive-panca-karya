<table class="table table-hover table-striped" width="100%" id="expenseDatatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Tempat Lahir</th>
            <th>Tgl. Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table
    let url = "{{ route('customer.datatable') }}"

    datatable(url)

    function datatable(url) {

        table = $('#expenseDatatable').DataTable({
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address',
                    orderable: false
                },
                {
                    data: 'no_telp',
                    name: 'no_telp',
                    orderable: false
                },
                {
                    data: 'place_of_birth',
                    name: 'place_of_birth',
                    orderable: false
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
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
