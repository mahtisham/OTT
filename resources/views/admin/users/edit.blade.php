@extends('layouts.admin')
@section('title',__('Edit')." ". $user->name)
@section('content')
  <div class="admin-form-main-block">
    <h4 class="admin-form-text">
      @can('users.view')
      <a href="{{url('admin/users')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Edit User')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">       
          {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'files' => true]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!! Form::label('name', __('Enter Name')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Name')}}"></i>
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required',]) !!}
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label('email',__('Email Address')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Email')}}"></i>
              {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
              <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
              {!! Form::label(' number',__('mobile no')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('enter your mobile no')}}"></i>
              {!! Form::number('mobile', null, ['class' => 'form-control', 'placeholder' => __('enter your mobile no')]) !!}
              <small class="text-danger">{{ $errors->first('mobile') }}</small>
            </div>
            <div class="form-group">
              {!! Form::label('address', __('Address')) !!}
              {{-- <p class="inline info"> - Please enter your address</p> --}} 
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Address')}}"></i>
              {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' =>'3', 'autofocus', 'placeholder' => __('Please Enter Your Address') ]) !!}
            </div>
            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
              <label for="country">{{__('Country')}}</label>
              {{-- <p class="inline info"> - Please enter your Country</p> --}} 
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Country')}}"></i>
              <select class="form-control"  name="country" id="country-dropdown" >
              <option value="">{{__('Select Your Country')}}</option>
              @foreach ($country as $c) 
              <option value="{{$c->id}}" {{$user->country == $c->id ? 'selected' : ''}}>
              {{$c->name}}
              </option>
              @endforeach
              </select>
              <small class="text-danger">{{ $errors->first('country') }}</small>
            </div>
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
              <label for="state">{{__('State')}}</label>
              {{-- <p class="inline info"> - Please enter your State</p> --}} 
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your state')}}"></i>
              <select class="form-control"  name="state" id="state-dropdown"  >
                <option value="">{{__('Select Your Country First')}}</option>
                @foreach ($state as $s) 
                <option value="{{$s->id}}" {{$user->state == $s->id ? 'selected' : ''}}>
                {{$s->name}}
                </option>
                @endforeach
              </select>
              <small class="text-danger">{{ $errors->first('state') }}</small>
              </div>                        
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
              <label for="city">{{__('City')}}</label>
              {{-- <p class="inline info"> - Please enter your City</p> --}} 
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your City')}}"></i>
              <select class="form-control"  name="city" id="city-dropdown">
                <option value="">{{__('Select Your State First')}}</option>
                  @foreach ($city as $ci) 
                  <option value="{{$ci->id}}" {{$user->city == $ci->id ? 'selected' : ''}}>
                  {{$ci->name}}
                  </option>
                  @endforeach
              </select>
              <small class="text-danger">{{ $errors->first('city') }}</small>
            </div>
           <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label('password', __('Password')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Password')}}"></i>
              {!! Form::password('password', ['id' => 'password',' class' => 'form-control', 'placeholder' => __('Please Enter Your Password')]) !!}
               <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
              <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
            <div class="search form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
              {!! Form::label('confirm_password', __('Confirm Password')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Passwor dAgain')}}"></i>
              {!! Form::password('confirm_password', ['id' => 'confirm_password','class' => 'form-control', 'placeholder' => __('Please Enter Your Password Again') ]) !!}
               <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
              <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
            </div>
            
            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
              {!! Form::label('role',__('Role')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Your Role')}}"></i>
              <select class="select2" name="role" id="">
                @foreach($roles as $role)
                 <option {{ $user->getRoleNames()->contains($role->name) ? 'selected' : "" }}  value="{{ $role->name }}">{{ucfirst($role->name) }}</option>
                @endforeach
              </select>
              <small class="text-danger">{{ $errors->first('role') }}</small>
            </div>

            <div class="search form-group{{ $errors->has('age') ? ' has-error' : '' }}">
              {!! Form::label('age', __('Age')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Age Of User')}}"></i>
             <input type="number" class="form-control" value="{{$user->age}}" name="age"  />
            
              <small class="text-danger">{{ $errors->first('age') }}</small>
            </div>
           
            
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success">{{__('Update')}}</button>
            </div>
          <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>  
      </div>
    </div>
  </div>
@endsection
@section('custom-script')
<script>
  $(function(){
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
    });
  });


  $(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
      $(document).ready(function() {
      $('#country-dropdown').on('change', function() {
      var country_id = this.value;
      $("#state-dropdown").html('');
      $.ajax({
      url:"{{url('get-states-by-country')}}",
      type: "POST",
      data: {
      country_id: country_id,
      _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
      $('#state-dropdown').html('<option value="">Select State</option>'); 
      $.each(result.states,function(key,value){  
      $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
      });
      $('#city-dropdown').html('<option value="">Select State First</option>'); 
      }
      });
      });    
      $('#state-dropdown').on('change', function() {
      var state_id = this.value;
      $("#city-dropdown").html('');
      $.ajax({
      url:"{{url('get-cities-by-state')}}",
      type: "POST",
      data: {
      state_id: state_id,
      _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
      $('#city-dropdown').html('<option value="">Select City</option>'); 
      $.each(result.cities,function(key,value){
      $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
      });
      }
      });
      });
      });
</script>
@endsection