@extends('layouts.admin')
@section('title',__('Create Package'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">  
    <h4 class="admin-form-text">
      @can('package.view')
        <a href="{{url('admin/packages')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Create Package')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'PackageController@store']) !!}
            <div class="form-group{{ $errors->has('plan_id') ? ' has-error' : '' }}">
                {!! Form::label('plan_id', __('PlanID')) !!}
                <p class="inline info"> - {{__('Unique Package')}}</p>
                {!! Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => __('Unique Package').' ex. basic10', 'data-placement' => 'bottom']) !!}
                <small class="text-danger">{{ $errors->first('plan_id') }}</small>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('Package Name')) !!}
                <p class="inline info"> - {{__('Please Enter Your Plan Name')}}</p>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            {!! Form::hidden('currency', $currency_code) !!}

            <div class="form-group{{ $errors->has('free') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('free', __('Free')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('free', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'free']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
               
                <small class="text-danger">{{ $errors->first('free') }}</small>
            </div>
    
            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}" id="planAmount">
                {!! Form::label('amount', __('Your Plan Amount')) !!}
                <p class="inline info"> -{{__('Plan Amount Min Max')}}</p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="{{$currency_symbol}}"></i></span>
                  {!! Form::number('amount', null, ['class' => 'form-control']) !!}  
                </div>
                <input type="text" name="currency_symbol" id="currency_symbol" value="{{$currency_symbol}}" hidden="true">
                <small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>

           <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('interval_count') ? ' has-error' : '' }}">
                        {!! Form::label('interval_count', __('Your Plan Duration')) !!}
                        <p class="inline info"> - {{__('PleaseEnterPlanDuration')}} </p>
                        {!! Form::number('interval_count', null, ['min' => 1, 'class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('interval_count') }}</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}">
                        {!! Form::label('interval', __('Plan Duration Unit')) !!}
                        <p class="inline info"> - {{__('Plan Duration Unit Description')}}</p>
                        {!! Form::select('interval', ['day'=>'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'year' => 'yearly'], ['month' => 'Monthly'], ['class' => 'form-control select2', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('interval') }}</small>
                     </div>
                </div> 
             </div>   
          </div>
           <div class="form-group{{ $errors->has('feature') ? ' has-error' : '' }}">
                {!! Form::label('feature',__('Package Feature')) !!} <span class="text-danger">*</span>
                <p class="inline info"> - {{__('Package Feature Notes')}}</p>
                <select class="select2 form-control" name="feature[]" multiple>
                  @foreach($p_feature as $pf)
                    <option value="{{$pf->id}}">{{$pf->name}}</option>
                  @endforeach
                </select>
                
                <small class="text-danger">{{ $errors->first('feature') }}</small>
            </div>
          <div class="menu-block">
              <h6 class="menu-block-heading">{{__('Please Select Menu')}}</h6>
              @if (isset($menus) && count($menus) > 0)
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox{{100}}" >
                        <label for="checkbox{{100}}" class="material-checkbox"></label>
                      </div>
                      {{__('All Menus')}}
                    </li>
                  @foreach ($menus as $menu)
                    <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                      </div>
                      {{$menu->name}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="form-group{{ $errors->has('trial_period_days') ? ' has-error' : '' }}">
                {!! Form::label('trial_period_days', __('Your Plan Trail Period Days')) !!}
                <p class="inline info"> - {{__('Your Plan Trail Period Days Description')}}</p>
                {!! Form::number('trial_period_days', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('trial_period_days') }}</small>
            </div>
            
            <div class="form-group{{ $errors->has('screen') ? ' has-error' : '' }}">
                {!! Form::label('screen', __('Screens')) !!}
                <p class="inline info"> - {{__('Screens Description')}}</p>
                {!! Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4']) !!}
                <small class="text-danger">{{ $errors->first('screen') }}</small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('download', __('Do You Want Download Limit')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('download', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('download') }}</small>
              </div>
            </div>
            <small class="text-danger">{{ $errors->first('downloadlimit') }}</small>
            <div id="downloadlimit" class="form-group{{ $errors->has('download limit') ? ' has-error' : '' }}" style="display:none">
                {!! Form::label('downloadlimit', __('DownloadLimit')) !!}
                <p class="inline info"> - {{__('Do You Want Download Limit Description')}}</p>
                {!! Form::number('downloadlimit', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{__('Note')}} :- <br/>
                  1. {{__('Download Note')}}.<br/>
                  2. {{__('Download limit Note')}}
                </small>
                
            </div>

            <!--------------- end download limit ------------------->
             @php
                $webconfig = App\Button::first();
            @endphp
            @if($webconfig->remove_ads == 1)
              <div class="form-group{{ $errors->has('ads_in_web') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-xs-6">
                    {!! Form::label('ads_in_web', __('Do you want show Ads in Web')) !!}
                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('ads_in_web', 1, 0, ['class' => 'checkbox-switch']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('ads_in_web') }}</small>
                </div>
              </div>
            @endif
             @php
                $appconfig = App\AppConfig::first();
            @endphp
            @if($appconfig->remove_ads == 1)
              <div class="form-group{{ $errors->has('ads_in_app') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-xs-6">
                    {!! Form::label('ads_in_app', __('Do you want show Ads in App')) !!}
                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('ads_in_app', 1, 0, ['class' => 'checkbox-switch']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('ads_in_app') }}</small>
                </div>
              </div>
            @endif

          
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status',__('Status')) !!} <span class="text-danger">*</span>
                <p class="inline info"> - {{__('Please select status')}}</p>
                <select class="select2 form-control" name="status">
                  <option value="active">{{__('Active')}}</option>
                  <option value="upcoming">{{__('Upcoming')}}</option>
                  <option value="inactive">{{__('In Active')}}</option>
                </select>
                
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Create')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>  
      </div>
    </div>
  </div>
@endsection
@section('custom-script')
<script type="text/javascript">
    // when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })

</script>
<script>
$('#download_enable').on('change',function(){
  if($('#download_enable').is(':checked')){
    //show
    $('#downloadlimit').show();
  }else{
    //hide
     $('#downloadlimit').hide();
  }
});


$('#free').on('change',function(){
  if($('#free').is(':checked')){
    //show
    $('#planAmount').hide();
  }else{
    //hide
     $('#planAmount').show();
  }
});
</script>
@endsection