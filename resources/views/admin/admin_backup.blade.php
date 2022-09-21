@extends('layouts.admin')
@section('title',__('Dashboard'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="alert alert-success alert-dismissible fade show">
        
        
      <span id="update_text">
        
      </span>

     <form action="{{ url("/merge-quick-update") }}" method="POST" class="float-right display-none updaterform">
        @csrf
        <input required type="hidden" value="" name="filename">
        <input required type="hidden" value="" name="version">
        <button class="btn btn-sm bg-green">
          {{__("Update Now")}}
        </button>
     </form>
     
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

    </div>
    <h4 class="admin-form-text">{{__('Dashboard')}}</h4>
    <br/>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{url('admin/users')}}" class="small-box z-depth-1 hoverable bg-aqua default-color">
          <div class="inner">
            <h3>{{$users_count}}</h3>
            <p>{{__('Total Users')}}</p>
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
            <p>{{__('Total LiveTv')}}</p>
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
        <div class="box box-solid">
          <div class="box-body">
            {!! $activesubsriber->container() !!}
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-solid">
          <div class="box-body">
            {!! $piechart->container() !!}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="box box-solid">
         <div class="box-body">
          {!! $doughnutchart->container() !!}
         </div>
       </div>
      </div>
      <div class="col-md-7">
       <div class="box box-solid">
         <div class="box-body">
           {!! $userchart->container() !!}
         </div>
       </div>
      </div>
    </div>
    <br>
      <div class="panel panel-default">
       <div class="panel-heading">{{__('Recently Registered Users')}}</div>
        <div class="panel-body">
          
          <div class="row">
            @foreach(App\User::where('is_admin','!=','1')->orderBy('id','DESC')->take(6)->get() as $user)
              <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username">{{ $user->name }}</h3>
                  
                </div>
                <div class="widget-user-image">
                  <img class="{{ $user->name }}" src="{{ Avatar::create( $user->name )->toBase64() }}" alt="{{__('User Avatar')}}">
                </div>
                <div class="box-footer">
                  <div class="row">
                    
                    <div class="col-sm-12 border-right">
                      <div class="description-block">
                        <h5 class="description-header">{{ $user->email }}</h5>
                        <span class="description-text">{{__('Email')}}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                   
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $userchart->script() !!}
{!! $activesubsriber->script() !!}
{!! $piechart->script() !!}
{!! $doughnutchart->script() !!}
@endsection

