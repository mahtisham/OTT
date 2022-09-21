@extends('layouts.theme')
@section('title',__("FAQ's"))
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid faq-main-block">
      <h4 class="heading">{{__('Frequently Asked Questions')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('Dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('Faq')}}</li>
      </ul>
      <div class="panel-setting-main-block">
        <div id="accordion" class="myaccordion">
          @if(isset($faqs))
            @foreach($faqs as $key => $faq)
              <div class="card">
                <div class="card-header" id="headingOne">
                  <div class="mb-0">
                    <button class="accordion-button btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-plus"></i><i class="fa fa-minus"></i> {{$faq->question}}
                    </button>
                  </div>
                </div>
                <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                    {{$faq->answer}}
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection