@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1> Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-end ">
              {{-- <h4 class="text-center">Data Pendapatan</h4> --}}
            <div class="right ">
              {{-- <button class="btn btn-warning btn-icon icon-left mr-3"><i class="fas fa-print"></i> Cetak Pendapatan</button> --}}
              <a href="{{route('income.print_form')}}" class="btn btn-success"> <i class="fas fa-print"></i> Cetak Pendapatan</a>
              @if (getRoleName() == 'staff')
                <a href="{{route('income.create')}}" class="btn btn-primary">Tambah Pendapatan</a>
              @endif
            </div>
          </div>
           <h4 class="text-center">Data Pendapatan</h4>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              {{-- <div class="bs-example"> --}}
                {{-- <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#incomeFix" class="nav-link {{!Session::get('active') ? 'active' : ''}}" data-toggle="tab">Pendapatan Lunas</a>
                    </li>
                    <li class="nav-item">
                        <a href="#incomeNotFix" class="nav-link {{Session::get('active') == 'incomeNotFix' ? 'active' : ''}}" data-toggle="tab">Piutang</a>
                    </li>
                </ul> --}}
                {{-- <div class="tab-content">
                    <div class="tab-pane fade {{!Session::get('active') ? 'active show' : ''}}" id="incomeFix"> --}}
                      @include('income.filter_datatable', ['tableId' => 'incomeDatatable'])
                      <hr>
                      @include('income.datatable')
                    {{-- </div>
                    <div class="tab-pane fade {{Session::get('active') == 'incomeNotFix' ? 'active show' : ''}}" id="incomeNotFix"> --}}
                      {{-- @include('income.filter_datatable', ['tableId' => 'incomeReceivable'])
                      <hr>
                      @include('income.receivable_datatable') --}}
                    {{-- </div> --}}
                {{-- </div>
              </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    function updateTable(tableid){
      const filterCustomer = document.getElementsByClassName('filter-customer')
      const filterIncomeType = document.getElementsByClassName('filter-income-type')
      const filterMonth = document.getElementsByClassName('filter-month')

      const param = `${filterCustomer[0].value}+${filterIncomeType[0].value}+${filterMonth[0].value}`
      $('#' + tableid).DataTable().ajax.url(url + `/${param}`).load();
    }
  </script>
@endpush
