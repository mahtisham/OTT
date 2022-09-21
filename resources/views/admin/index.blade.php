@extends('layouts.admin')
@section('title',__('Dashboard'))
@section('content')
  <div class="content-main-block mrg-t-40">
   
    <h4 class="admin-form-text">{{__('Dashboard')}}</h4><br/>
  @can('dashboard.states')
    <div class="alert alert-warning alert-dismissible update-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <form action="{{ url("/admin/merge-quick-update") }}" method="POST" class="float-right display-none updaterform">
        @csrf
        <input required type="hidden" value="" name="filename">
        <input required type="hidden" value="" name="version">
        <button class="btn btn-sm bg-primary pull-right">
          {{__("Update Now")}}
        </button>
      </form>
      <span id="update_text">
        
      </span>
    </div>
   
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-header">
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-lg-8">
                  <h5 class="box-title">{{__('Welcome back, your dashboard is ready!')}}</h5>
                  <p>{{Artisan::output()}}</p>
                </div>
                <div class="col-lg-4">
                  <div class="box-btn text-right">
                    <a href="{{url('admin/settings')}}" class="btn btn-primary">{{__('Setup Your Site')}} <i class="material-icons right">arrow_forward</i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      
    </div>
   
    <br/>
    
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/users')}}" class="small-box z-depth-1 hoverable bg-aqua default-color">
          <div class="inner">
            <h3>{{$users_count}}</h3>
            <p>{{__('Tota lUsers')}}</p>
          </div>
          <div class="icon">
           <i class="fa fa-users" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/users')}}" class="small-box z-depth-1 hoverable bg-olive">
          <div class="inner">
            <h3>{{ $activeusers }}</h3>
            <p>{{__('Total Active Users')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/movies')}}" class="small-box z-depth-1 hoverable bg-red danger-color">
          <div class="inner">
            <h3>{{$movies_count}}</h3>
            <p>{{__('Total Movies')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-film" aria-hidden="true"></i>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/tvseries')}}" class="small-box z-depth-1 hoverable bg-green success-color">
          <div class="inner">
            <h3>{{$tvseries_count}}</h3>
            <p>{{__('Total Tv Serieses')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-video-o" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/livetv')}}" class="small-box z-depth-1 hoverable bg-yellow pink darken-4">
          <div class="inner">
            <h3>{{$livetv_count}}</h3>
            <p>{{__('Total Live Tv')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-tv" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/packages')}}" class="small-box z-depth-1 hoverable bg-yellow secondary-color">
          <div class="inner">
            <h3>{{$package_count}}</h3>
            <p>{{__('Total Packages')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-sticky-note" aria-hidden="true"></i>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/coupons')}}" class="small-box z-depth-1 hoverable bg-green warning-color">
          <div class="inner">
            <h3>{{$coupon_count}}</h3>
            <p>{{__('Total Coupons')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-ticket" aria-hidden="true"></i>
          </div>
        </a>
      </div>
     
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/genres')}}" class="small-box z-depth-1 hoverable bg-aqua  grey darken-2">
          <div class="inner">
            <h3>{{$genres_count}}</h3>
            <p>{{__('Total Genres')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-filter" aria-hidden="true"></i>
          </div>
        </a>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-7">
        <div class="box box-seconday-header">
          <div class="box-header">
            <h3 class="box-title">{{__('Active Subscribed Users in ' . date('Y'))}}</h3>
          </div>
          <div class="box-body no-padding">
            {!! $activesubsriber->container() !!}
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">{{__('User Distribution')}}</h3>
          </div>
          <div class="box-body">
            {!! $piechart->container() !!}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">{{__('Revenue Report')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <table id="full_detail_table" class="table table-hover db" style="width: 100%">
              <thead>
                <tr class="table-heading-row">
                  <th>
                    #
                  </th>
                  <th>{{__('Payment ID')}}</th>
                  <th>{{__('UserName')}}</th>
                  
                  <th>{{__('Payment Method')}}</th>
                  <th>{{__('Paid Amount')}}</th>
                  <th>{{__('Subscription From')}}</th>
                  <th>{{__('Subscription To')}}</th>
                </tr>
              </thead>
              @if ($revenue_report)

                <tbody>
                  @foreach ($revenue_report as $key => $report)
                    <tr id="item-{{$report->id}}">
                      <td>
                        {{$key+1}}
                      </td>
                      <td>{{$report->payment_id}}</td>
                      <td>{{ucfirst($report->user_name)}}</td>
                      <td>{{$report->method}}</td>
                      <td><i class="{{ $currency_symbol }}" aria-hidden="true"></i>{{$report->price}}</td>
                      <td>{{$report->subscription_from}}</td>
                      <td>{{$report->subscription_to}}</td>
                    </tr>
                  @endforeach
                </tbody>
              @endif
            </table>
          </div>
        </div>
      </div>
     
    </div>
    <br/>
    <div class="row">
      <div class="col-md-5">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">{{__('Video Distributions')}}</h3>
          </div>
         <div class="box-body">
          {!! $doughnutchart->container() !!}
         </div>
       </div>
      </div>
      <div class="col-md-7">
       <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">{{__('Monthly Registered Users in ' . date('Y'))}}</h3>
        </div>
         <div class="box-body">
           {!! $userchart->container() !!}
         </div>
       </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-7">
        <div class="box box-primary">
          <div class="box-body no-padding">
            {!! $revenue_chart->container() !!}
          </div>
        </div>
       
      </div>
      <div class="col-md-5">
        <!-- USERS LIST -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">{{__('Recently Register Users')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($latest_users as $user)
              <li>
                <img src="{{Avatar::create($user->name)->toBase64()}}" alt="User Image" width="50">
                <a class="users-list-name" href="#">{{$user->name}}</a>
                <span class="users-list-date">{{date('M d, Y',strtotime($user->created_at))}}</span>
              </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <a href="{{url('admin/users')}}" class="uppercase">View All Users</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!--/.box -->
      </div>

      
    </div>
  @else
  <div class="row">
    <div class="col-md-12">
      <div class="dashboard-header">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-lg-8">
                <h5 class="box-title">{{__('Welcome back, your dashboard is ready!')}}</h5>
                <p>{{Artisan::output()}}</p>
              </div>
              {{-- <div class="col-lg-4">
                <div class="box-btn text-right">
                  <a href="{{url('admin/settings')}}" class="btn btn-primary">{{__('Setup Your Site')}} <i class="material-icons right">arrow_forward</i></a>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
     
    </div>
    
  </div>
  @endcan
  </div>
@endsection
@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $userchart->script() !!}
{!! $activesubsriber->script() !!}
{!! $piechart->script() !!}
{!! $doughnutchart->script() !!}
{!! $revenue_chart->script() !!}
@endsection

