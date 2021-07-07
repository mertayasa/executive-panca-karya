@if (str_contains(Route::currentRouteName(), 'edit'))
    {!! Form::hidden('user_id', $staff->user->id, []) !!}
@endif

<div class="row">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseName', 'Nama Staff', ['class' => 'mb-1']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'expenseName']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expenseEmail', 'Email', ['class' => 'mb-1']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'expenseEmail']) !!}
    </div>
</div>
<div class="row mt-3">
     <div class="col-12 col-md-6">
        {!! Form::label('expenseGender', 'Jenis Kelamin', ['class' => 'mb-1']) !!}
        {!! Form::select('gender', [0 => 'Laki-Laki', 1 => 'Perempuan'], null, ['class' => 'form-control', 'id' => 'expenseGender']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('expensePassword', 'Password', ['class' => 'mb-1']) !!}
        {!! Form::password('password',  ['class' => 'form-control', 'id' => 'expensePassword']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseDate', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
    </div>
     <div class="col-12 col-md-6">
        {!! Form::label('expenseTelp', 'No. Telepon', ['class' => 'mb-1']) !!}
        {!! Form::number('telp', null, ['class' => 'form-control', 'id' => 'expenseTelp']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('expenseAddress', 'Alamat', ['class' => 'mb-1']) !!}
        {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'expenseAddress', 'style' => 'height:150px']) !!}
    </div>
</div>