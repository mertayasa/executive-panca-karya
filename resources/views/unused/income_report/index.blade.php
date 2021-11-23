@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header justify-content-center">
        <h1>Laporan Pendapatan</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12 col-md-4">
                {!! Form::select('filter_month', $monthly, $month_selected, ['class' => 'form-control', 'onchange' => 'updateTable(this.value)']) !!}
              </div>
              <div class="col-12 col-md-6 mt-3 mt-md-0">
                <button class="btn btn-warning btn-icon icon-left float-right float-md-left py-1 py-md-2"><i class="fas fa-print"></i> Print Excel</button>
              </div>
            </div>
        <section class="section mt-lg-5">
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="kop">
                      <h1>Laporan Pendapatan</h1>
                      <h2>CV. Panca Karya Manunggal</h2>
                      <h3>Jl. Merdeka, Bebalang, Kec. Bangli, Kab. Bangli,Bali</h3>
                      <hr>
                    </div>
                    <hr>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      @include('income_report.datatable_income')
                    </div>
                    <hr>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Total Pendaapatan</div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Subtotal</div>
                          <div class="invoice-detail-value">{{formatPrice($totals)}}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </section>
      </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
    <script>
      function updateTable(date){
        url = "{{ route('income_report.datatable') }}"
        $('#incomeReportDatatable').DataTable().ajax.url(url + `/${date}`).load();
      }
    </script>
@endpush
