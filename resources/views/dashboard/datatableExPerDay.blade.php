<table class="table table-hover table-striped" width="100%" id="ExpenPerDayDatatable">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-right">Total Pengeluaran (Rp)</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>
    let tableEx
    let urlEx = "{{ route('dashboard.datatableExPerDay') }}"

    datatable(urlEx)

    function datatable(urlEx) {

        tableEx = $('#ExpenPerDayDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: urlEx,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'no',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    className: "text-right"
                },

            ],
            // order: [[ 1, "DESC" ]],
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