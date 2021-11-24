<table class="table table-hover table-bordered" width="100%" id="expenseDatatable">
    <thead class="text-center">
        <tr>
            <th class="text-center">No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th class="text-center">No. Telp</th>
            {{-- <th>Tempat Lahir</th>
            <th>Tgl. Lahir</th>
            <th>Jenis Kelamin</th> --}}
            <th>Kategori</th>
            <th>Status</th>
            @if (getRoleName() == 'staff')
                <th class="text-center">Aksi</th>
            @endif
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

        let columns = [{
                    data: 'DT_RowIndex',
                    name: 'no',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
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
                    orderable: false,
                    className: "text-center"
                },
                // {
                //     data: 'place_of_birth',
                //     name: 'place_of_birth',
                //     orderable: false
                // },
                // {
                //     data: 'date',
                //     name: 'date',
                //     orderable: false
                // },
                // {
                //     data: 'gender',
                //     name: 'gender'
                // },
                  {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'status',
                    name: 'status'
                }

            ]

        @if(getRoleName() == 'staff')
            columns.push({
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
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
