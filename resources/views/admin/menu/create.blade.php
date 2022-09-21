@extends('layouts.admin')
@section('title',__('Create Menu'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('menu.view')
      <a href="{{url('admin/menu')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a>
      @endcan
       {{__('Create Menu')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'MenuController@store']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Menu Name')}} eg:Home"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Please Enter Menu Name')]) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group" class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
              <label>{{__('ChooseSection')}}: <span class="text-danger">*</span></label>
              <br>
              <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('Menu Will Contain Following Section')}}</small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('Atlease One Section Is Required')}}</small>

              <br><br>

              <label>
                <div class="inline">
                  <input value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                {{__('Recently Added')}} 
              </label>
              <br>

              <div style="display: none" class="section1">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section1">
                 
                   <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                {{__('Genre')}} 
              </label>
              <div style="display: none" class="section2">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="All Genre">Select Genre</label> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select these genre you want to show on home page"></i><br/>
                    <select name="genre_id[]" id="" class="form-control select2" multiple="">
                       @if($all_genre)
                        @foreach($all_genre as $genre)
                          <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section2">
                 
                   <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
    
              <br>
              <label>
                <div class="inline">
                  <input value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                {{__('Featured')}}
              </label>
           
                <div style="display: none" class="section3">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[3]" id="select3" class="form-control">
                     <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section3">
                 
                   <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              
              <br>
              <label>
                <div class="inline">
                  <input value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                {{__('Best On Intrest')}}
              </label>
           
                <div style="display: none" class="section4">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section4">
                 
                   <div class="form-group">
                    <label>{{__('OrderIn')}}:</label>
                    <select name="order[4]" id="select4" class="form-control">
                     <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>

              <br/>

              <label>
                <div class="inline">
                  <input value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                {{__('Continue Watch')}}
              </label>
           
                <div style="display: none" class="section5">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[5]" id="select5" class="form-control">
                     <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section5">
                 
                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              
              <br/>


               <label>
                <div class="inline">
                  <input value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
               {{__('Languages')}}
              </label>
           
                <div style="display: none" class="section6">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[6]" id="select6" class="form-control">
                     <option value="1">{{__('Slide View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

              <div style="display: none" class="section6">
                 
                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              
              <br/>
                <label>
                <div class="inline">
                  <input value="7" id="pramotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="pramotion" class="material-checkbox"></label>
                </div>
                {{__('Movie Tvseries Pramotion')}}
              </label>
              <br/>
              <label>
                <div class="inline">
                  <input value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                {{__('Blog')}}
              </label>


              <br/>
               <label>
                <div class="inline">
                  <input value="9" id="upcoming" type="checkbox" class="filled-in" name="section[9]">
                  <label for="upcoming" class="material-checkbox"></label>
                </div>
                {{__('UpcomingMovie')}}
              </label>
           
                <div style="display: none" class="section9">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input id="limit9" type="number" min="1" name="limit[9]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[9]" id="select9" class="form-control">
                     <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>
              </div>

               <div style="display: none" class="section9">
                 
                   <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[9]" id="select9" class="form-control">
                      <option value="1">{{__('DESC Order')}}</option>
                      <option value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              
              <br>

              <label>
                <div class="inline">
                  <input value="10" id="liveevent" type="checkbox" class="filled-in" name="section[10]">
                  <label for="liveevent" class="material-checkbox"></label>
                </div>
                {{__('Live Event')}}
              </label>
              <br/>
              <label>
                <div class="inline">
                  <input value="11" id="audio" type="checkbox" class="filled-in" name="section[11]">
                  <label for="audio" class="material-checkbox"></label>
                </div>
                {{__('Audio')}}
              </label>
                <small class="text-danger">{{ $errors->first('section') }}</small>
              <br/>
              @if($topsection == 1)
               <label>
                  <div class="inline">
                    <input value="12" id="topReated" type="checkbox" class="filled-in" name="section[12]">
                    <label for="toprated" class="material-checkbox"></label>
                  </div>
                  {{__('Top Rated Section')}}
                </label>
                <br/>
              @endif
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
  <script>
    
      $('#recent_added').on('change',function(){
           
          if($(this).is(':checked')){
              $('.section1').show('fast');
              $('#limit1').attr('required','required');
              $('#order1').attr('required','required');
              $('#select1').attr('required','required');
          }else{
            $('.section1').hide('fast');
            $('#limit1').removeAttr('required');
             $('#order1').removeAttr('required','required');
            $('#select1').removeAttr('required');
          }
      });

      $('#genre_added').on('change',function(){
          if($(this).is(':checked')){
            $('.section2').show('fast');
            $('#limit2').attr('required','required');
             $('#order2').attr('required','required');
            $('#select2').attr('required','required');
          }else{
            $('.section2').hide('fast');
            $('#limit2').removeAttr('required');
             $('#order2').removeAttr('required','required');
            $('#select2').removeAttr('required');
          }
      });

      $('#featured').on('change',function(){
          if($(this).is(':checked')){
            $('.section3').show('fast');
            $('#limit3').attr('required','required');
             $('#order3').attr('required','required');
            $('#select3').attr('required','required');
          }else{
            $('.section3').hide('fast');
            $('#limit3').removeAttr('required');
             $('#order3').removeAttr('required','required');
            $('#select3').removeAttr('required');
          }
      });

      $('#intrest').on('change',function(){
          if($(this).is(':checked')){
            $('.section4').show('fast');
            $('#limit4').attr('required','required');
             $('#order4').attr('required','required');
            $('#select4').attr('required','required');
          }else{
            $('.section4').hide('fast');
            $('#limit4').removeAttr('required');
             $('#order4').removeAttr('required','required');
            $('#select4').removeAttr('required');
          }
      });

      $('#history').on('change',function(){
          if($(this).is(':checked')){
            $('.section5').show('fast');
            $('#limit5').attr('required','required');
             $('#order5').attr('required','required');
            $('#select5').attr('required','required');
          }else{
            $('.section5').hide('fast');
            $('#limit5').removeAttr('required');
             $('#order5').removeAttr('required','required');
            $('#select5').removeAttr('required');
          }
      });

      $('#language').on('change',function(){
          if($(this).is(':checked')){
            $('.section6').show('fast');
            $('#limit6').attr('required','required');
             $('#order6').attr('required','required');
            $('#select6').attr('required','required');
          }else{
            $('.section6').hide('fast');
            $('#limit6').removeAttr('required');
             $('#order6').removeAttr('required','required');
            $('#select6').removeAttr('required');
          }
      });

   
   
  </script>
@endsection
