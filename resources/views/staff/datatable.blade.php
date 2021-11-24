<table class="table table-hover table-striped" width="100%" id="expenseDatatable">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let table
    let url = "{{ route('staff.datatable') }}"

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
                    data: 'user.name',
                    name: 'name'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                // {
                //     data: 'age',
                //     name: 'age'
                // },
                // {
                //     data: 'status',
                //     name: 'status'
                // },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'telp',
                    name: 'telp',
                    orderable: false
                },
                {
                    data: 'user.email',
                    name: 'email',
                    orderable: false
                },
                {
                    data: 'address',
                    name: 'address',
                    orderable: false
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