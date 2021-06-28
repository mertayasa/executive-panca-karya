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
</div>
