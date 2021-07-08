<div class="row">
    <div class="col-2"></div>
     <div class="col-12 col-md-8">
        {!! Form::label('expenseDate', 'Tanggal', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseType', 'Jenis Pendapatan ', ['class' => 'mb-1']) !!}

      {!! Form::select('id_types', $income_type, null, ['class' => 'form-control', 'id' => 'expanseType']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseTotal', 'Total ', ['class' => 'mb-1']) !!}
        {!! Form::text('total', null, ['class' => 'form-control', 'id' => 'expenseTotal']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
        {!! Form::label('expenseKet', 'Keterangan ', ['class' => 'mb-1']) !!}
        {!! Form::text('ket', null, ['class' => 'form-control', 'id' => 'expenseKet']) !!}
    </div>
     <div class="col-2"></div>
</div>
<div class="row mt-3">
    <div class="col-2"></div>
    <div class="col-12  col-md-8">
         {!! Form::label('expenseStatus', 'Status', ['class' => 'mb-1']) !!}
        {!! Form::select('status', [0 => 'Lunas', 1 => 'Utang'], null, ['class' => 'form-control', 'id' => 'expenseStatus']) !!}
    </div>
     <div class="col-2"></div>
</div>


