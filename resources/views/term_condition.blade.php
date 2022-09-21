@extends('layouts.theme')
@section('title',__('Terms and Condition'))
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper user-account-section">
    <div class="container-fluid faq-main-block terms-main-block">
      <h4 class="heading">{{__('Terms and Condition')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('Dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('Terms and Condition')}}</li>
      </ul>
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-9">              
              @if(isset($term_con))
                <div class="info">{!! $term_con !!}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection