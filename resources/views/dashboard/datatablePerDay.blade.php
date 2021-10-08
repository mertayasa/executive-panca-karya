<table class="table table-hover table-striped" width="100%" id="IncomePerDayDatatable">
    <thead>
        <tr>
        <th class="text-center">No</th>
        <th class="text-center">Tanggal</th>
        <th class="text-right">Total Pendapatan (Rp)</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>

    let table
    let url = "{{ route('dashboard.datatablePerDay') }}"

    datatable(url)
    function datatable (url){

        table = $('#IncomePerDayDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [ {
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
                    data: 'total',
                    name: 'total',
                    className: "text-right"
                },
            
            ],
            // order: [[ 1, "DESC" ]],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets:  '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1, targets: 1
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
