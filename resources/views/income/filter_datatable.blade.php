<div class="row align-items-center mb-3 mt-3">
    <div class="col-12 col-md-4 mt-3 mt-md-0">
        {!! Form::select('filter_customer', $customers, null, ['class' => 'form-control filter-customer', 'placeholder' => 'Filter Pelanggan', 'onchange' => 'updateTable("'. $tableId .'")']) !!}
    </div>
    <div class="col-12 col-md-4 mt-3 mt-md-0">
        {!! Form::select('filter_income_type', $income_types, null, ['class' => 'form-control filter-income-type', 'placeholder' => 'Filter Jenis Pendapatan', 'onchange' => 'updateTable("'. $tableId .'")']) !!}
    </div>
    <div class="col-12 col-md-4 mt-3 mt-md-0">
        {!! Form::select('filter_month', $monthly, $month_selected, ['class' => 'form-control filter-month', 'placeholder' => 'Filter Bulan', 'onchange' => 'updateTable("'. $tableId .'")']) !!}
    </div>
</div>