@extends('layouts.app')

@section('content')
<section class="section">
    {{-- <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-users-cog"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Staff </h4>
            </div>
            <div class="card-body">
              {{$dashboard_data['staff_count']}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Customer </h4>
            </div>
            <div class="card-body">
              {{$dashboard_data['customer_count']}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-wallet"></i> 
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Pendapatan </h4>
            </div>
            <div class="card-body">
              {{ formatPrice($dashboard_data['income_count']) }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-file-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4> Piutang </h4>
            </div>
            <div class="card-body">
              {{ formatPrice($dashboard_data['receiavable_count']) }}
            </div>
          </div>
        </div>
      </div>


    </div> --}}

  <div class="row mt-5 ">
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img" style="background-color: #343e5f" >
          </div>
          <div class="card-custom-avatar">
           <a href=" {{route('customer.index')}} ">  <span><i class="fa fa-users"></i> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pelanggan</h5>
              <div class="icon">
                {{$dashboard_data['customer_count']}}
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img"  style="background-color:#9a7e83" >
          </div>
          <div class="card-custom-avatar">
              <a href=" #income_per_day "> <span><center><i class="fas fa-wallet"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pendapatan</h5>
              <div class="icon">
               {{ formatPrice($dashboard_data['income_count']) }} 
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img " style="background-color:#acbda6" >
          </div>
          <div class="card-custom-avatar">
           <a href=" #expen_per_day ">  <span><center><i class="fas fa-wallet"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Pengeluaran</h5>
              <div class="icon">
                 {{ formatPrice($dashboard_data['receiavable_count']) }}
              </div>
          </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img " style="background-color:#bdbba6" >
          </div>
          <div class="card-custom-avatar">
           <a href=" #expen_per_day ">  <span><center><i class="fas fa-wallet"></i></center> </span> </a>
          </div>
          <div class="card-body pt-3">
            <h5 class="card-title mb-4">Total Piutang</h5>
              <div class="icon">
                 {{ formatPrice($dashboard_data['receiavable_count']) }}
              </div>
          </div>
        </div>
    </div>
  </div>


    @if (getRoleName() == 'staff')
      @include('dashboard.chart_staff')      
    @else
      @include('dashboard.chart')      
    @endif


</section>
@endsection
