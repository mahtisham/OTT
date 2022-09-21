<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
   <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
    <title>{{ __('Installing App - Server Requirement') }}</title>
  </head>
  <body>
     
      <div class="display-none preL">
        <div class="display-none preloader3"></div>
      </div>

      <div class="container">
        @if ($errors->any())
            <br>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center heading">
                  {{ __('Server Requirement') }}
              </h3>
          </div>
          <div class="card-body" id="stepbox">
               <form autocomplete="off" action="{{ route('store.server') }}" id="step1form" method="POST" class="needs-validation" novalidate>
                  @csrf
                  @php
                    $servercheck= array();
                  @endphp
                  <div class="form-row">
                      <br>
                     <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>{{ __('php extension') }}</th>
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
                                 <small class="text-muted">{{__('php version required greater than 7.3')}}</small>
                              </td>
                              <td>
                               @if($v = 7.4 || $v < 8)
                                 <i class="text-success fa fa-check-circle"></i>
                                 @php
                                   array_push($servercheck, 1);
                                 @endphp
                               @else
                                <i class="text-danger fa fa-times-circle"></i>
                                <br> 
                                 <small>
                                   {{__('Your php version is')}} <b>{{ $v }}</b> {{__('which is not supported')}}
                                 </small>
                                 @php
                                   array_push($servercheck, 0);
                                 @endphp
                               @endif
                              </td>
                            </tr>

                             <tr>
                              <td>{{ __('pdo') }}</td>
                              <td>
                               
                                  @if (extension_loaded('pdo'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('cURL') }}</td>
                              <td>
                                  @if (extension_loaded('cURL'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                             <tr>
                              <td>{{ __('BCMath') }}</td>
                              <td>
                               
                                  @if (extension_loaded('BCMath'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('openssl') }}</td>
                              <td>
                               
                                  @if (extension_loaded('openssl'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                              <tr>
                              <td>{{ __('fileinfo') }}</td>
                              <td>
                               
                                  @if (extension_loaded('fileinfo'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('json') }}</td>
                              <td>
                               
                                  @if (extension_loaded('json'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('session') }}</td>
                              <td>
                               
                                  @if (extension_loaded('session'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>

                             <tr>
                              <td>{{ __('gd') }}</td>
                              <td>
                               
                                  @if (extension_loaded('gd'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                    @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>


                            
                            <tr>
                              <td>{{ __('allow_url_fopen') }}</td>
                              <td>
                               
                                  @if (ini_get('allow_url_fopen'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                      @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                             

                            

                             <tr>
                              <td>{{ __('xml') }}</td>
                              <td>
                               
                                  @if (extension_loaded('xml'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                     @endphp
                                  @endif
                              </td>
                            </tr>

                             <tr>
                              <td>{{ __('tokenizer') }}</td>
                              <td>
                               
                                  @if (extension_loaded('tokenizer'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>
                             <tr>
                              <td>{{ __('standard') }}</td>
                              <td>
                               
                                  @if (extension_loaded('standard'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>

                              <tr>
                              <td>{{ __('mysqli') }}</td>
                              <td>
                               
                                  @if (extension_loaded('mysqli'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('mbstring') }}</td>
                              <td>
                               
                                  @if (extension_loaded('mbstring'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>

                             <tr>
                              <td>{{ __('ctype') }}</td>
                              <td>
                               
                                  @if (extension_loaded('ctype'))
                                       
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                    @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
                                  @endif
                              </td>
                            </tr>

                            <tr>
                              <td>{{ __('exif') }}</td>
                              <td>
                                
                                  @if (extension_loaded('exif'))
                                      
                                    <i class="text-success fa fa-check-circle"></i> 
                                     @php
                                      array_push($servercheck, 1);
                                      @endphp
                                  @else
                                     <i class="text-danger fa fa-times-circle"></i>
                                     @php
                                      array_push($servercheck, 0);
                                    @endphp
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
                     <i class="text-success fa fa-check-circle"></i> 
                    @else
                      <i class="text-danger fa fa-times-circle"></i>
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
                      <i class="text-success fa fa-check-circle"></i> 
                    @else
                      <i class="text-danger fa fa-times-circle"></i>
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
                      <i class="text-success fa fa-check-circle"></i> 
                    @else
                      <i class="text-danger fa fa-times-circle"></i>
                    @endif
                  </td>
                </tr>


                          </tbody>
                        </table>
                        </div>
                     </div>
                     
                  </div>
                  @if(!in_array(0, $servercheck))
                    <button class="float-right step1btn btn btn-default" type="submit">{{ __('Continue to Installation') }}...</button>
                  @else
                    <p class="pull-right text-danger"><b>{{ __('Some extension are missing. Contact your host provider for enable it.') }}</b></p>
                  @endif
              </form>
          </div>
        </div>
       <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('Server Check') }} </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ url('installer/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('installer/js/jquery.validate.min.js') }}"></script>
    <!-- jquery -->
    <script type="text/javascript" src="{{url('installer/js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="{{url('installer/js/popper.min.js')}}"></script> 
    <script src="{{ url('installer/js/shards.min.js') }}"></script>
    <script>var baseUrl= "<?= url('/') ?>";</script>
</body>
</html>