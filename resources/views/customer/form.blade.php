<div class="row">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseName', 'Nama Pelanggan', ['class' => 'mb-1']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'expenseName']) !!}
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('expenseTelp', 'No. Telepon', ['class' => 'mb-1']) !!}
        {!! Form::number('no_telp', null, ['class' => 'form-control', 'id' => 'expenseTelp']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseAddress', 'Alamat', ['class' => 'mb-1']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'expenseAddress', 'style' => 'height:150px']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expenseCategory', 'Katagori', ['class' => 'mb-1']) !!}
        {!! Form::select('category', [0 => 'Perorangan', 1 => 'Instansi'], null, ['class' => 'form-control', 'id' => 'expenseCategory']) !!}
    </div>
</div>

<div class="row mt-3">
    @if (str_contains(Route::currentRouteName(), 'edit'))
        <div class="col-12 col-md-6">
            {!! Form::label('expenseStatus', 'Status', ['class' => 'mb-1']) !!}
            {!! Form::select('status', [0 => 'Tidak Aktif', 1 => 'Aktif'], null, ['class' => 'form-control', 'id' => 'expenseStatus']) !!}
        </div>
    @endif
</div>
