@extends('layouts.app')
@section('title', 'Pendapatan')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Pilih Tanggal Data Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        @include('layouts.flash')
                        @include('layouts.error_message')
                        {!! Form::open(['route' => 'income.search_for_print']) !!}
                        <div class="row mt-3">
                            <div class="col-12  pb-3 pb-md-0">
                                {!! Form::label('startDate', 'Tanggal Mulai', ['class' => 'mb-1']) !!}
                                {!! Form::date('start_date', isset($request) ? $request->start_date : null, ['class' => 'form-control', 'id' => 'startDate']) !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12  pb-3 pb-md-0">
                                {!! Form::label('endDate', 'Tanggal Selesai', ['class' => 'mb-1']) !!}
                                {!! Form::date('end_date', isset($request) ? $request->end_date : null, ['class' => 'form-control', 'id' => 'endDate']) !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="{{ route('income.index') }}" class="btn btn-danger">Kembali</a>
                                <button class="btn btn-primary ml-3" type="submit">Cari Data</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (isset($income_data))
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Data Pendapatan {{indonesianDate($request->start_date)}} - {{indonesianDate($request->end_date)}}</h4>
                            @if (count($income_data) > 0)
                                <a href="{{route('income.print', [$request->start_date, $request->end_date])}}" class="btn btn-warning"> <i class="fas fa-print"></i> Cetak Pendapatan</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Tanggal Pendapatan</th>
                                            <th>Tanggal Pelunasan </th>
                                            <th>Pelanggan</th>
                                            <th>Jenis Pendapatan</th>
                                            <th >Keterangan</th>
                                            <th>Total (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp
                                        @forelse ($income_data as $income)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$income->invoice_no}}</td>
                                                <td>{{indonesianDateNew($income->date)}}</td>
                                                <td>{{indonesianDateNew($income->paid_date)}}</td>
                                                <td>{{$income->customer->name}}</td>
                                                <td>{{$income->income_type->name}}</td>
                                                <td >{{$income->ket}}</td>
                                                <td>{{$income->total}}</td>
                                                {{-- <td>
                                                    <ol class="pl-3">
                                                        @foreach ($income->income_log as $log)
                                                            <li>
                                                                <span class="mb-0"> <b> {{ indonesianDateTime($log->created_at) }} </b> </span>
                                                                <span class="d-inline-block ml-3 {{ $log->income_status == 2 ? 'text-success' : ( $log->income_status == 3 ? 'text-danger' : '') }}"> {{ getincomeStatus($log->income_status, true) }} </span>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </td> --}}
                                                {{-- <td>{{getincomeStatus($income->status, true)}}</td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
