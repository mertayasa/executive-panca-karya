@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-center">
            <h1>Dashboard</h1>
        </div>

        <div class="row mt-5 ">
            <div class="col-md-4 col-sm-6">
                <div class="card card-custom bg-white border-white border-0">
                    <div class="card-custom-img" style="background-color: #343e5f">
                    </div>
                    <div class="card-custom-avatar">
                        <a href=" {{ route('customer.index') }} "> <span><i class="fa fa-users"></i> </span> </a>
                    </div>
                    <div class="card-body pt-3">
                        <h5 class="card-title mb-4">Total Pelanggan</h5>
                        <div class="icon">
                            {{ $dashboard_data['customer_count'] }}
                        </div>
                    </div>
                </div>
            </div>
            
            @if (getRoleName() == 'owner')
                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img" style="background-color: #343e5f">
                        </div>
                        <div class="card-custom-avatar">
                            <a href=" {{ route('customer.index') }} "> <span><i class="fa fa-users"></i> </span> </a>
                        </div>
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-4">Total Staff</h5>
                            <div class="icon">
                                {{ $dashboard_data['staff_count'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img" style="background-color:#9a7e83">
                        </div>
                        <div class="card-custom-avatar">
                            @if (getRoleName() == 'staff')
                                <a href=" #income_per_day "> <span>
                                        <center><i class="fas fa-wallet"></i></center>
                                    </span> </a>
                            @else
                                <a href=" {{ route('income.index') }} "> <span>
                                        <center><i class="fas fa-wallet"></i></center>
                                    </span> </a>
                            @endif
                        </div>
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-4">Total Pendapatan Bruto</h5>
                            <div class="icon">
                                {{ formatPrice($dashboard_data['income_count']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img " style="background-color:#acbda6">
                        </div>
                        <div class="card-custom-avatar">
                            @if (getRoleName() == 'staff')
                                <a href=" #expen_per_day "> <span>
                                        <center><i class="fas fa-wallet"></i></center>
                                    </span> </a>
                            @else
                                <a href=" {{ route('expenditure.index') }} "> <span>
                                        <center><i class="fas fa-wallet"></i></center>
                                    </span> </a>
                            @endif
                        </div>
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-4">Total Pengeluaran</h5>
                            <div class="icon">
                                {{ formatPrice($dashboard_data['expenditure_count']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img " style="background-color:#bdbba6">
                        </div>
                        <div class="card-custom-avatar">
                            <a href="{{ route('receivable.index') }} "> <span>
                                    <center><i class="fas fa-wallet"></i></center>
                                </span> </a>
                        </div>
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-4">Total Piutang</h5>
                            <div class="icon">
                                {{ formatPrice($dashboard_data['receiavable_count']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                  <div class="card card-custom bg-white border-white border-0">
                      <div class="card-custom-img" style="background-color:#9a7e83">
                      </div>
                      <div class="card-custom-avatar">
                          @if (getRoleName() == 'staff')
                              <a href=" #income_per_day "> <span>
                                      <center><i class="fas fa-wallet"></i></center>
                                  </span> </a>
                          @else
                              <a href=" {{ route('income.index') }} "> <span>
                                      <center><i class="fas fa-wallet"></i></center>
                                  </span> </a>
                          @endif
                      </div>
                      <div class="card-body pt-3">
                          <h5 class="card-title mb-4">Total Pendapatan Bersih</h5>
                          <div class="icon">
                              {{ formatPrice($dashboard_data['income_count']  - $dashboard_data['expenditure_count']) }}
                          </div>
                      </div>
                  </div>
              </div>

          </div>
        @else
        <div class="col-md-4 col-sm-6">
          <div class="card card-custom bg-white border-white border-0">
              <div class="card-custom-img" style="background-color:#9a7e83">
              </div>
              <div class="card-custom-avatar">
                  @if (getRoleName() == 'staff')
                      <a href=" #income_per_day "> <span>
                              <center><i class="fas fa-wallet"></i></center>
                          </span> </a>
                  @else
                      <a href=" {{ route('income.index') }} "> <span>
                              <center><i class="fas fa-wallet"></i></center>
                          </span> </a>
                  @endif
              </div>
              <div class="card-body pt-3">
                  <h5 class="card-title mb-4">Total Pendapatan (Hari Ini)</h5>
                  <div class="icon">
                      {{ formatPrice($dashboard_data['income_daily_count']) }}
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4 col-sm-6">
          <div class="card card-custom bg-white border-white border-0">
              <div class="card-custom-img " style="background-color:#acbda6">
              </div>
              <div class="card-custom-avatar">
                  @if (getRoleName() == 'staff')
                      <a href=" #expen_per_day "> <span>
                              <center><i class="fas fa-wallet"></i></center>
                          </span> </a>
                  @else
                      <a href=" {{ route('expenditure.index') }} "> <span>
                              <center><i class="fas fa-wallet"></i></center>
                          </span> </a>
                  @endif
              </div>
              <div class="card-body pt-3">
                  <h5 class="card-title mb-4">Total Pengeluaran (Hari Ini)</h5>
                  <div class="icon">
                      {{ formatPrice($dashboard_data['expenditure_daily_count']) }}
                  </div>
              </div>
          </div>
      </div>
        @endif


        @if (getRoleName() == 'staff')
            @include('dashboard.chart_staff')
        @else
            @include('dashboard.chart')
        @endif


    </section>
@endsection
