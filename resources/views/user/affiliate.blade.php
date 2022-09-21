@extends('layouts.theme')
@php
  $user = Auth::user();
@endphp
@section('title',__('Affiliate Dashboard').' | ')
@section('main-wrapper')
<section id="main-wrapper" class="main-wrapper user-account-section affiliate-block">
  <div class="container-fluid">
    <div class="row">

      <div class="col-xl-9 col-lg-12 col-sm-12">

        <div class="bg-white2 " style="color:white">
          <a href="#howitworks" data-toggle="modal" class="mt-2 h6 pull-right">
              {{ __("How it works ?") }}
          </a>
          
          <h4 class="user_m2">{{ __('Affiliate Dashboard') }}</h4>
          
          <hr>
          <div class="container text-center">
            <div class="card">
              <div class="card-body">
                  <h3 class="card-title">
                      {{__("Start refering your friends and start earning !!")}}
                  </h3><br>
                  <p class="card-text">
                      {{__("This is your unique refer link share with your friends and family and start earning !")}}
                  </p>
                  <div class="form-group">
                      <input type="text" readonly class="text-dark text-center form-control cptext" value="{{ route('register',['refercode' => auth()->user()->refer_code ]) }}">
                  </div>
                <a href="#" class="copylink btn btn-default">
                    {{ __("Copy Link") }}
                </a>
              </div>
            </div>
          </div>

          <div id="howitworks" class="comment-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      {!! $af_settings->about_system !!}
                    </div>
                  </div>
              </div>
          </div>

          <div class="walletlogs">
        
            @if($aff_history->count())
          
            <hr>
            <h4 class="pull-right">{{ __('Total earning') }}  <i class="{{ $currency_symbol }}"></i> {{ $earning }}  
            
            </h4>
            <h4>{{ __('Affiliate history') }}</h4>
          
            <hr>

            @foreach($aff_history as $history)
          
            <h6>
              <span  class="pull-right text-green""> {{ __('+') }}  <i class="{{ $currency_symbol }}"></i> {{ sprintf("%.2f",$history->amount,2) }}
               
              </span>
              {{ $history->log }}
              
              <small class="text-muted font-size-12 wallet-log-history-block">
                @if($history->procces == 0)
                
                <small class="text-white ">
                  ({{ __("Pending") }})
                </small>

                @else 
                  <small class="text-white">({{ __("Credited to wallet") }})</small>
                @endif
                
              </small>
            </h6>
            <hr>
            @endforeach
            @endif

            @if(isset($aff_history))
            <div class="mx-auto width200px">
              {!! $aff_history->links() !!}
            </div>
            @endif
          </div>

        </div>
      </div>


    </div>

  </div>
</section>


@endsection
@section('script')
    <script>
        $('.copylink').on('click', function () {
            $(this).text('Copied !');
            var copyText = $('.cptext').val();
            console.log(copyText);
            $('.cptext').select();
            document.execCommand("copy");
        });
    </script>
@endsection