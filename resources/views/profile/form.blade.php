<div class="row mt-3">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('userName', 'Nama', ['class' => 'mb-1']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'userName']) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('userEmail', 'Email', ['class' => 'mb-1']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'userEmail']) !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('userPassword', 'Password', ['class' => 'mb-1']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'userPassword']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('confirmPassword', 'Konfirmasi Password', ['class' => 'mb-1']) !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'confirmPassword']) !!}
    </div>
</div>

@if ($user->level == 0)
    <hr>
    <div class="row mt-3">
        <div class="col-12 col-md-6">
            {!! Form::label('expenseGender', 'Jenis Kelamin', ['class' => 'mb-1']) !!}
            {!! Form::select('gender', [0 => 'Laki-Laki', 1 => 'Perempuan'], null, ['class' => 'form-control', 'id' => 'expenseGender']) !!}
        </div>
        <div class="col-12 col-md-6">
            {!! Form::label('expenseDate', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
            {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'expenseDate']) !!}
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6">
            {!! Form::label('expenseAddress', 'Alamat', ['class' => 'mb-1']) !!}
            {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'expenseAddress', 'style' => 'height:150px']) !!}
        </div>
        <div class="col-12 col-md-6">
            {!! Form::label('expenseTelp', 'No. Telepon', ['class' => 'mb-1']) !!}
            {!! Form::number('telp', null, ['class' => 'form-control', 'id' => 'expenseTelp']) !!}
        </div>
    </div>
@endif
