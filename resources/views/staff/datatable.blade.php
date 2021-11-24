<table class="table table-hover table-striped" width="100%" id="expenseDatatable">
    <thead class="text-center">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal Lahir</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Telepon</th>
            <th class="text-center">Email</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">Aksi</th>
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
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'user.name',
                    name: 'name'
                },
                {
                    data: 'date',
                    name: 'date',
                    className: 'text-center'
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
                    orderable: false,
                    className: 'text-center'
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
                    searchable: false,
                    className: 'text-center'
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