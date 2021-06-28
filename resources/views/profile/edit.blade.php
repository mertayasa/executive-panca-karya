@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Profile</h4>
            {{-- <a href="{{route('patient.create')}}" class="btn btn-primary">Tambah Registrasi</a> --}}
          </div>
          <div class="card-body">
            @include('layouts.flash')
            {!! Form::open(['route' => 'customer.store']) !!}
            @include('profile.form')
            <div class="row mt-3" >
                <div class="col-12" style="margin-top: 20px">
                    <a href="{{'/'}}" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary ml-3" type="submit">Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
