@extends('layouts.admin')
@section('title', __('Push Notification'))

@section('content')
<div class="admin-form-main-block">
    <h4>{{__('Push Notification')}}</h4><br>
   <div class="row ">
       <div class="col-md-7 ">
       
            <div class="content-block box-body admin-form-block z-depth-1">
                <form action="{{ route('admin.push.notif') }}" method="POST">
                    @csrf
    
                    <div class="form-group">
                        <label for="">{{__('SelectUserGroup')}}: <span class="text-danger">*</span> </label>
    
                        <select required data-placeholder="{{__('Please Select User Group')}}" name="user_group" id="" class="select2 form-control">
                            <option value="">{{__('Please Select User Group')}}</option>
                            <option {{ old('user_group') == 'all_customers' ? "selected" : "" }} value="all_customers">{{__('All Users')}}</option>
                            <option {{ old('user_group') == 'all_sellers' ? "selected" : "" }} value="all_sellers">{{__('All Producers')}}</option>
                            <option {{ old('user_group') == 'all_admins' ? "selected" : "" }} value="all_admins">{{__('All Admins')}}</option>
                            <option {{ old('user_group') == 'all' ? "selected" : "" }} value="all">{{__('All')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Subject')}}: <span class="text-red">*</span></label>
                        <input placeholder="{{__('Hey New Stock Arrived')}}" type="text" class="form-control" required name="subject" value="{{ old('subject') }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Notification Body')}}: <span class="text-red">*</span> </label>
                        <textarea required placeholder="{{__('Notification Body Note')}}" class="form-control" name="message" id="" cols="3" rows="5">{{ old('message') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Target URL')}}: </label>
                        <input value="{{ old('target_url') }}" class="form-control" name="target_url" type="url" placeholder="{{ url('/') }}">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> {{__('Target URL Note')}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Notification Icon')}}: </label>
                        <input value="{{ old('icon') }}" name="icon" class="form-control" type="url" placeholder="https://someurl/icon.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> {{__('Notification Icon Note')}}.
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="">{{__('Image')}}: </label>
                        <input value="{{ old('image') }}" class="form-control" name="image" type="url" placeholder="https://someurl/image.png">
                        <small class="text-muted">
                            <i class="fa fa-question-circle"></i> <b>{{__('Notification Image Size')}}.</b>
                        </small>
                    </div>

                    <div class="from-group">
                        <label for="">{{__('Show Button')}}: </label>
                        <br>
                        <label class="make-switch">
                            <input  class="bootswitch show_button" type="checkbox" name="show_button" onChange ='isshow()' data-on-text="On" data-off-text="{{__('OFF')}}" data-size="{{__('small')}}">
                        </label>
                    </div>

                    <div id="buttonBox">
                        <div class="form-group">
                            <label for="">{{__('Button Text')}}:  <span class="text-danger">*</span></label>
                            <input value="{{ old('btn_text') }}" class="form-control" name="btn_text" type="text" placeholder="{{__('Grab Now')}}">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('Button Target URL')}}: </label>
                            <input value="{{ old('btn_url') }}" class="form-control" name="btn_url" type="url" placeholder="https://someurl/image.png">
                            <small class="text-muted">
                                <i class="fa fa-question-circle"></i> {{__('Button Target URL Note')}}.
                            </small>
                        </div>
                    </div>

                    <div class="from-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">
                            <i class="fa fa-location-arrow"></i> {{__('Send')}}
                        </button>
                    </div>
    
                </form>
            </div>
       </div>

       <div class="col-md-4">
           <div class="box">
               <div class="box-header">
                   <div class="box-title">
                        {{__('One signal Keys')}}
                   </div>

                   <a title="Get one signal keys" href="https://onesignal.com/" class="pull-right" target="__blank">
                       <i class="fa fa-key"></i> {{__('Get Your Keys From Here')}}
                   </a>
               </div>

               <div class="content-block box-body  admin-form-block z-depth-1">
                   
                <form action="{{ route('admin.onesignal.keys') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_APP_ID"> {{__('ONE SIGNAL APP ID')}}: <span class="text-danger">*</span></label>
                            <input type="password" value="{{ env('ONESIGNAL_APP_ID') }}"
                                name="ONESIGNAL_APP_ID" placeholder="{{__('Enter ONE SIGNAL APP ID')}} " id="ONESIGNAL_APP_ID" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_APP_ID"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_REST_API_KEY"> {{__('ONE SIGNAL REST API KEY')}}: <span class="text-danger">*</span></label>
                            <input type="password" value="{{ env('ONESIGNAL_REST_API_KEY') }}"
                                name="ONESIGNAL_REST_API_KEY" placeholder="{{__('Enter ONE SIGNAL REST API KEY')}} " id="ONESIGNAL_REST_API_KEY" type="password"
                                class="form-control">
                            <span toggle="#ONESIGNAL_REST_API_KEY"
                                class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md">
                           <i class="fa fa-save"></i> {{__('Save Keys')}}
                        </button>
                    </div>
                </form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection
@section('custom-script')
    <script>
        // if($('.show_button').is(":checked")){
        //      $('input[name=btn_text]').attr('required','required');
        //         $('#buttonBox').show();
        // } else{
        //      $('input[name=btn_text]').removeAttr('required');
        //         $('#buttonBox').hide();
        // }

        function isshow(){
            if($('.show_button').is(":checked"))   
            $('input[name=btn_text]').attr('required','required');
           $('#buttonBox').show();
            else
            $('input[name=btn_text]').removeAttr('required');
               $('#buttonBox').hide();
        }
       
    </script>
@endsection