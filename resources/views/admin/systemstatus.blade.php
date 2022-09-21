@extends('layouts.admin')
@section('title',__('System Status'))
@section('content')
<div class="content-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text">{{__('System Status')}}</h4>
  </div>
 <div class="content-block box-body table-responsive">

    @php

        $results = DB::select( DB::raw('SHOW VARIABLES LIKE "%version%"') );
    
        foreach ($results as $key => $result) {

            if($result->Variable_name == 'version' ){
                $db_info[] = array(
                    'value'   => $result->Value
                );
            }

            if($result->Variable_name == 'version_comment' ){
                $db_info[] = array(
                    'value'   => $result->Value
                );
            }
        }

        $servercheck= array();

    @endphp

   

        
        <div id="message"></div>

        <table class="table table-striped">
          

            <tbody>
                <tr>
                    <td>
                        <b>{{__('Laravel Version')}}</b>
                    </td>
                    <td>
                        {{ App::version() }} <i class="fa fa-check-circle text-green"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table class="table table-bordered table-striped">
            <thead>
                
                <th colspan="2">
                    {{__('MYSQL Version Info')}}
                </th>
                <th>
                    {{__('Status')}}
                </th>
                
            </thead>
            

            <tbody>
               @foreach($db_info as $key => $info)
                    <tr>
                        <td>
                            {{ $key == 0 ? __('MYSQL Version') : __('Server Type') }}
                        </td>
                        <td>
                            {{ $info['value'] }}
                        </td>
                        <td>
                            @if($key == 0 && $info['value'] < 5.7)
                                @php
                                    array_push($servercheck, 0);
                                @endphp
                                <i class="fa fa-times-circle text-red"></i>
                            @else
                                @php
                                    array_push($servercheck, 1);
                                @endphp
                            <i class="fa fa-check-circle text-green"></i>
                            @endif
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{{ __('PHP Extensions') }}</th>
                <th>{{ __('Status') }}</th>
              </tr>
            </thead>

            <tbody>

              <tr>
                @php
                    $v = phpversion();
                @endphp
                <td>
                  {{ __('php version') }} (<b>{{ $v }}</b>)
                  <br>
                  <small class="text-muted">{{__('PHP Version Note')}}</small>
                </td>
                <td>

                 @if($v = 7.0 && $v < 7.5) <i class="text-green fa fa-check-circle"></i>
                        @php
                            array_push($servercheck, 1);
                        @endphp
                    @else
                        @php
                            array_push($servercheck, 1);
                        @endphp
                    <i class="text-red fa fa-times-circle"></i>
                    <br>
                    <small>
                      {{__('Your php version is')}} <b>{{ $v }}</b>{{__('Which is not supported')}}
                    </small>
                   
                    @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('pdo') }}</td>
                <td>

                  @if (extension_loaded('pdo'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('BC Math') }}</td>
                <td>

                  @if (extension_loaded('BC Math'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('open ssl') }}</td>
                <td>

                  @if (extension_loaded('open ssl'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('file info') }}</td>
                <td>

                  @if (extension_loaded('file info'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('json') }}</td>
                <td>

                  @if (extension_loaded('json'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('session') }}</td>
                <td>
                    

                  @if (extension_loaded('session'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('gd') }}</td>
                <td>

                  @if (extension_loaded('gd'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>



              <tr>
                <td>{{ __('allow_url_fopen') }}</td>
                <td>

                  @if (ini_get('allow_url_fopen'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                    
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>





              <tr>
                <td>{{ __('xml') }}</td>
                <td>

                  @if (extension_loaded('xml'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('tokenizer') }}</td>
                <td>

                  @if (extension_loaded('tokenizer'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>
              <tr>
                <td>{{ __('standard') }}</td>
                <td>

                  @if (extension_loaded('standard'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('mysqli') }}</td>
                <td>

                  @if (extension_loaded('mysqli'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('mbstring') }}</td>
                <td>

                  @if (extension_loaded('mbstring'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                 
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('ctype') }}</td>
                <td>

                  @if (extension_loaded('ctype'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-green fa fa-check-circle"></i>
                  
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp

                    <i class="text-red fa fa-times-circle"></i>
                  
                  @endif
                </td>
              </tr>

              <tr>
                <td>{{ __('exif') }}</td>
                <td>

                  @if (extension_loaded('exif'))

                        @php
                            array_push($servercheck, 1);
                        @endphp

                  <i class="text-green fa fa-check-circle"></i>
                
                  @else

                        @php
                            array_push($servercheck, 1);
                        @endphp
                  
                  <i class="text-red fa fa-times-circle"></i>
                 
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{storage_path()}}</b> {{ __('is writable') }}?</td>
                <td>
                  @php
                    $path = storage_path();
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp
                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{base_path('bootstrap/cache')}}</b> {{ __('is writable') }}?</td>
                <td>
                  @php
                    $path = base_path('bootstrap/cache');
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>

              <tr>
                <td><b>{{storage_path('framework/sessions')}}</b> {{ __('is writable') }}?</td>
                <td>
                  @php
                    $path = storage_path('framework/sessions');
                  @endphp
                  @if(is_writable($path))

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-green fa fa-check-circle"></i>
                  @else

                    @php
                        array_push($servercheck, 1);
                    @endphp

                  <i class="text-red fa fa-times-circle"></i>
                  @endif
                </td>
              </tr>


            </tbody>
          </table>

            

       
  </div>
</div>
@endsection
@section('custom-script')
    <script>
        @if(!in_array(0, $servercheck))
            $("#message").html('<div class="callout callout-success"><i class="fa fa-check-circle"></i> {{ __("SuccessMessage") }}</div>');
        @else
            $('#message').html(' <div class="callout callout-danger"><i class="fa fa-times-circle"></i> {{ __("ErrorMessage") }}</div>');
        @endif
    </script>
@endsection