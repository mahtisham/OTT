@extends('layouts.admin')
@section('title',__('Edit Package'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('package.view')
        <a href="{{url('admin/packages')}}" data-toggle="tooltip" data-original-title="{{__('GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Edit Package')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($package, ['method' => 'PATCH', 'action' => ['PackageController@update', $package->id]]) !!}
            <div class="form-group{{ $errors->has('plan_id') ? ' has-error' : '' }}">
                {!! Form::label('plan_id',  __('PlanID')) !!}
                <p class="inline info"> - {{__('Unique Package')}}</p>
                {!! Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => 'Create Your Unique Plan ID ex. basic10', 'data-placement' => 'bottom']) !!}
                <small class="text-danger">{{ $errors->first('plan_id') }}</small>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('Plan Name')) !!}
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
                    {!! Form::checkbox('free', 1, $package->free, ['class' => 'checkbox-switch seriescheck','id'=>'free']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <small class="text-danger">{{ $errors->first('free') }}</small>
            </div>
    
            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}"  style="{{$package->free == 1 ? 'display: none' : ''}}" id="planAmount">
                {!! Form::label('amount', __('Your Plan Amount')) !!}
                <p class="inline info"> -{{__('Plan Amount Min Max')}}</p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="{{$currency_symbol}}"></i></span>
                  {!! Form::number('amount', null, ['class' => 'form-control']) !!}  
                </div>
                @if($package->currency_symbol=='')
                 <input type="text" name="currency_symbol" id="currency_symbol" value="{{$currency_symbol}}" hidden="true">
                 @else
                   <input type="text" name="currency_symbol" id="currency_symbol" value="{{$package->currency_symbol}}" hidden="true">
                 @endif
                <small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>

            <div class="form-group{{ $errors->has('feature') ? ' has-error' : '' }}">
                {!! Form::label('feature', __('Package Feature')) !!}<span class="text-danger">*</span>
               <p class="inline info"> - {{__('Package Feature Notes')}}</p>
                 <select name="feature[]" class="select2 form-control" multiple>
                     @foreach($p_feature as $pf)
                      <option @isset($package['feature']) @foreach($package['feature'] as $opf) {{ $opf == $pf['id'] ? "selected" : "" }}  @endforeach @endisset value="{{$pf->id}}">{{$pf->name}} </option>
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
                        <input @foreach($menu->getpackage as $pkg) {{ $pkg->menu_id == $menu->id && $package->id == $pkg->pkg_id? "checked" : "" }} @endforeach type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                      </div>
                      {{$menu->name}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="form-group{{ $errors->has('screens') ? ' has-error' : '' }}">
                {!! Form::label('screens', __('Screens')) !!}
                <p class="inline info"> - {{__('Screens Description')}}</p>
                {!! Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4']) !!}
                <small class="text-danger">{{ $errors->first('screens') }}</small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('download', __('Do You Want Download Limit')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('download', 1, $package->download, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('download') }}</small>
              </div>
            </div>
            <small class="text-danger">{{ $errors->first('downloadlimit') }}</small>
            <div id="downloadlimit" class="form-group{{ $errors->has('downloadlimit') ? ' has-error' : '' }}" style="{{ $package->download != '' ? ""  : "display:none" }}">
                {!! Form::label('downloadlimit', __('DownloadLimit')) !!}
                <p class="inline info"> - {{__('Do You Want Download Limi tDescription')}}</p>
                {!! Form::number('download limit', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('ads_in_web', __('Do you want Remove Ads in Web')) !!}
                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('ads_in_web', 1, $package->ads_in_web, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']) !!}
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
                  {!! Form::label('ads_in_app', __('Do you want Remove Ads in App')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('ads_in_app', 1, $package->ads_in_app, ['class' => 'checkbox-switch seriescheck']) !!}
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
                {!! Form::label('status',__('Status')) !!}<span class="text-danger">*</span>
                <p class="inline info"> - {{__('Please select status')}}</p>
                 <select name="status" class="select2 form-control">
                    <option value="active" {{$package->status == 'active' ? 'selected' :''}}>{{__('Active')}}</option>
                    <option value="upcoming" {{$package->status == 'upcoming' ? 'selected' :''}}>{{__('Upcoming')}}</option>
                    <option value="inactive" {{$package->status == 'inactive' ? 'selected' :''}}>{{__('In Active')}}</option>
                  </select>
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </div>
           
            
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Update')}}</button>
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
    $(document).ready(function(){
      var check = [];
    
    $('.one').each(function(index){

      if($(this).is(':checked')){
        check.push(1);
      }else{
        check.push(0);
      }

    });
   console.log(check);
    var flag = 1;

    if (jQuery.inArray(0, check) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }

  });

    // if one checkbox is unchecked remove checked on all menu option

    $(".one").click(function(){
      if($(this).is(':checked'))
      {
       
        var checked = [];
       $('.one').each(function(){
        if($(this).is(':checked')){
          checked.push(1);
        }else{
          checked.push(0);
        }
       })
       
       var flag = 1;

    if (jQuery.inArray(0, checked) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

       if(flag == 0){
        $('.all').prop('checked',false);
       }else{
         $('.all').prop('checked',true);
       }
      }
      else{
        
        $('.all').prop('checked',false);
      }
    });

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