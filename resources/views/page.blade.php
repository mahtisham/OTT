@extends('layouts.theme')
@section('title',"$custom->title")
@section('main-wrapper')

<section id="main-wrapper" class="main-wrapper user-account-section">
    <div class="container-fluid faq-main-block terms-main-block">
      <h3 class="heading">{{$custom->title}}</h3>
     
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-9">              
              @if(isset($custom))
                <div class="info">{{$custom->detail}}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection