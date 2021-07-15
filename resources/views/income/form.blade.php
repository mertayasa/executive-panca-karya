<div class="row px-0">
    <div class="col-12 col-md-8 m-auto px-0">
        {!! Form::label('customerId', 'Pelanggan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_customer', $customers, null, ['class' => 'form-control', 'id' => 'customerId', 'disabled' => isset($income) ? true : false]) !!}
    </div>
</div>
<div class="row px-0 mt-3">
    <div class="col-12 col-md-8 m-auto px-0">
        {!! Form::label('incomeDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'incomeDate', 'disabled' => isset($income) ? true : false]) !!}
    </div>
</div>
<div class="row px-0 mt-3">
    <div class="col-12  col-md-8 m-auto px-0">
        {!! Form::label('incomeType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}
        {!! Form::select('id_income_type', $income_type, null, ['class' => 'form-control', 'id' => 'incomeType']) !!}
    </div>
</div>
<div class="row px-0 mt-3">
    <div class="col-12  col-md-8 m-auto px-0">
        {!! Form::label('incomerTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::number('total', null, ['class' => 'form-control', 'id' => 'incomerTotal']) !!}
    </div>
</div>
<div class="row px-0 mt-3">
    <div class="col-12  col-md-8 m-auto px-0">
        {!! Form::label('incomeStatus', 'Status', ['class' => 'mb-1']) !!}
        {!! Form::select('status', [1 => 'Lunas', 0 => 'Utang'], null, ['class' => 'form-control', 'id' => 'incomeStatus', 'disabled' => isset($income) ? true : false]) !!}
    </div>
</div>
<div class="row px-0 mt-3">
    <div class="col-12  col-md-8 m-auto px-0">
        {!! Form::label('incomeKet', 'Keterangan ', ['class' => 'mb-1']) !!}
        {!! Form::textarea('ket', null, ['class' => 'form-control', 'id' => 'incomeKet', 'style' => 'height:150px']) !!}
    </div>
</div>

@push('scripts')
    <script>
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });
        @if(str_contains(Route::currentRouteName(), 'create'))
            const incomeDate = document.getElementById('incomeDate').value = new Date().toDateInputValue()
        @endif
    </script>
@endpush


