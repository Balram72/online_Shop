@extends('admin/layout')
@section('page_title','Dashboard')
@section('dashboard_select', 'active')
@section('container')
    <h1> Dashboard</h1>

                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <a href="{{ url('admin/customer') }}"><i class="zmdi zmdi-account-o"></i></a>
                                    </div>
                                    <br/>
                                   
                                    <div class="text">
                                            <h2>{{ $total_users }}</h2>
                                            <span> All Customer</span>
                                    </div>
                                </div>
                                <div class="overview-chart" hidden>
                                    <canvas id="widgetChart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1" style="background-image: -webkit-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                       <a href="{{ url('admin/order') }}"> <i class="zmdi zmdi-account-o"></i></a>
                                    </div>
                                    <br/>
                                    <div  class="text">
                                        <h2>{{ $items_solid }}</h2>
                                        <span>Items Saled</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1" style="background-image: -webkit-linear-gradient(90deg, #ee0979 0%, #ff6a00">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <a href="{{ url('admin/order') }}"><i class="zmdi zmdi-account-o"></i></a>
                                    </div>
                                    <br/>
                                    <div class="text">
                                        <h2>{{ $cancle_order }}</h2>
                                        <span>Cancle Order</span>
                                    </div>
                                </div>
                                {{-- <div class="overview-chart">
                                    <canvas id="widgetChart1"></canvas>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1" style="background-image: -webkit-linear-gradient(90deg, #45b649 0%, #dce35b 100%);">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <br/>
                                    <div class="text">
                                        <h2>Rs.{{ $total_earnings }}</h2>
                                        <span>total earnings</span>
                                    </div>
                                </div>
                                {{-- <div class="overview-chart">
                                    <canvas id="widgetChart1"></canvas>
                                </div> --}}
                            </div>
                        </div>
                    </div>
   
                </div>  
@endsection