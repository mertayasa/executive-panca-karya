<div class="row">
    <div class="col-12  pb-3 pb-md-0">
        {!! Form::label('expenseName', 'Nama Pelanggan', ['class' => 'mb-1']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'expenseName']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expensePlaceOfBirth', 'Tempat Lahir', ['class' => 'mb-1']) !!}
        {!! Form::text('place_of_birth', null, ['class' => 'form-control', 'id' => 'expensePlaceOfBirth']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expenseDate', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseGender', 'Jenis Kelamin', ['class' => 'mb-1']) !!}
        {!! Form::select('gender', [0 => 'Laki-Laki', 1 => 'Perempuan'], null, ['class' => 'form-control', 'id' => 'expenseGender']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expenseStatus', 'Status', ['class' => 'mb-1']) !!}
        {!! Form::select('status', [0 => 'Aktif', 1 => 'Tidak Aktif'], null, ['class' => 'form-control', 'id' => 'expenseStatus']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseTelp', 'No. Telepon', ['class' => 'mb-1']) !!}
        {!! Form::number('no_telp', null, ['class' => 'form-control', 'id' => 'expenseTelp']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expenseAddress', 'Alamat', ['class' => 'mb-1']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'expenseAddress', 'style' => 'height:150px']) !!}
    </div>
</div>


