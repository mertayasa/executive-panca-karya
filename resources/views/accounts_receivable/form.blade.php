<div class="row">
    <div class="card card-statistic-2" style="margin-bottom: 0px">
        <div class="card-icon-v bg-primary">
          <h1>100</h1>
        </div>
      </div>
</div>

<div class="row mt-3">
    <div class="col-12  pb-3 pb-md-0">
        {!! Form::label('expenseQue', 'No Kunjungan', ['class' => 'mb-1']) !!}
        {!! Form::number('que', null, ['class' => 'form-control', 'id' => 'expenseQue']) !!}
    </div>
</div>

<div class="row mt-3 d-none">
    <div class="col-12  pb-3 pb-md-0 ">
        {!! Form::label('expenseID', 'ID Pasien', ['class' => 'mb-1']) !!}
        {!! Form::number('id_patient', $patient->id , ['class' => 'form-control', 'id' => 'expenseID']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12  pb-3 pb-md-0">
        {!! Form::label('expenseName', 'Nama Pasien', ['class' => 'mb-1']) !!}
        {!! Form::text('name', $patient->name, ['class' => 'form-control', 'id' => 'expenseName','readonly' => true]) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12  pb-3 pb-md-0">
        {!! Form::label('expenseDate', 'Tanggal Kunjungan', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12  pb-3 pb-md-0">
        {!! Form::label('expenseKeterangan', 'Keterangan', ['class' => 'mb-1']) !!}
        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'id' => 'expenseKeterangan', 'style' => 'height:150px']) !!}
    </div>
</div>


