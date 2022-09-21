@extends('layouts.admin')
@section('title',__('Edit')." ". $menu->name)
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('menu.view')
        <a href="{{url('admin/menu')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Edit Menu')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($menu, ['method' => 'PATCH', 'action' => ['MenuController@update', $menu->id]]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Menu Name')}}eg:Home"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            @if(count($menu->menusections)>0)
             <div class="form-group" class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
              <label>{{__('Choose Section')}}: <span class="text-danger">*</span></label>
              <br>
              <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('Menu Will Contain Following Section')}}</small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('Atlease One Section Is Required')}}</small>


              <br><br>

              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 1)  checked="checked" @endif @endforeach value="1" id="recent_added" type="checkbox" class="filled-in" name="section[1]">
                  <label for="recent_added" class="material-checkbox"></label>
                </div>
                {{__('Recently Added')}} 
              </label>
              <br>

              <div style="@foreach($menu->menusections as $section) @if($section->section_id == 1) display:block @else display:none @endif @endforeach " class="section1">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 1) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit1" type="number" min="1" name="limit[1]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[1]" id="select1" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 1 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slider View')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 1 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[1]" id="select1" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 1 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 1 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>

              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 2)  checked="checked" @endif @endforeach value="2" id="genre_added" type="checkbox" class="filled-in" name="section[2]">
                  <label for="genre_added" class="material-checkbox"></label>
                </div>
                Genre 
              </label>

               <div style="@foreach($menu->menusections as $section) @if($section->section_id == 2) display:block @else display:none @endif @endforeach " class="section2">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 2) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit2" type="number" min="1" name="limit[2]" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="All Genre">Select Genre</label> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select these genre you want to show on home page"></i><br/>
                    <select name="genre_id[]" id="" class="form-control select2" multiple="">
                       @if($all_genre)
                        @foreach($all_genre as $genre)
                          <option @if($select_genre) @foreach($select_genre as $sgenre) @if($genre->id == $sgenre->genre_id) selected="" @endif @endforeach @endif value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[2]" id="select2" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 2 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slide rView')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 2 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[2]" id="select2" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 2 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 2 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              <br>
              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 3)  checked="checked" @endif @endforeach value="3" id="featured" type="checkbox" class="filled-in" name="section[3]">
                  <label for="featured" class="material-checkbox"></label>
                </div>
                {{__('Featured')}}
              </label>
               <div style="@foreach($menu->menusections as $section) @if($section->section_id == 3) display:block @else display:none @endif @endforeach " class="section3">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 3) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit3" type="number" min="1" name="limit[3]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[3]" id="select3" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 3 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slider View')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 3 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[3]" id="select3" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 3 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 3 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
                <br>
                
               <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 4)  checked="checked" @endif @endforeach value="4" id="intrest" type="checkbox" class="filled-in" name="section[4]">
                  <label for="intrest" class="material-checkbox"></label>
                </div>
                {{__('Best On Intrest')}}
              </label>
               <div style="@foreach($menu->menusections as $section) @if($section->section_id == 4) display:block @else display:none @endif @endforeach " class="section4">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 4) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit4" type="number" min="1" name="limit[4]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[4]" id="select4" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 4 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slider View')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 4 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[4]" id="select4" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 4 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 4 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>

              <br/>

                  <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 5)  checked="checked" @endif @endforeach value="5" id="history" type="checkbox" class="filled-in" name="section[5]">
                  <label for="history" class="material-checkbox"></label>
                </div>
                {{__('Continue Watch')}}
              </label>
               <div style="@foreach($menu->menusections as $section) @if($section->section_id == 5) display:block @else display:none @endif @endforeach " class="section5">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 5) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit5" type="number" min="1" name="limit[5]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[5]" id="select5" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 5 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slider View')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 5 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[5]" id="select5" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 5 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 5 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              <br/>

              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 6)  checked="checked" @endif @endforeach value="6" id="language" type="checkbox" class="filled-in" name="section[6]">
                  <label for="language" class="material-checkbox"></label>
                </div>
               {{__('Languages')}}
              </label>
               <div style="@foreach($menu->menusections as $section) @if($section->section_id == 6) display:block @else display:none @endif @endforeach " class="section6">
                  <div class="form-group">
                    <label>{{__('Limit')}}:</label>
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 6) value="{{ $section->item_limit }}" @else  @endif  @endforeach id="limit6" type="number" min="1" name="limit[6]" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>{{__('View In')}}:</label>
                    <select name="view[6]" id="select6" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 6 && $section->view == 1) selected="selected" @else  @endif  @endforeach value="1">{{__('Slider View')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 6 && $section->view == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
                    <select name="order[6]" id="select6" class="form-control">
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 6 && $section->order== 1) selected="selected" @else  @endif  @endforeach value="1">{{__('DESC Order')}}</option>
                      <option @foreach($menu->menusections as $section) @if($section->section_id == 6 && $section->order == 0) selected="selected" @else  @endif  @endforeach value="0">{{__('ASC Order')}}</option>
                    </select>
                  </div>
              </div>
              <br/>

              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 7)  checked="checked" @endif @endforeach value="7" id="parmotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="parmotion" class="material-checkbox"></label>
                </div>
                {{__('Movie Tvseries Pramotion')}}
              </label>
              <br/>
              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 8)  checked="checked" @endif @endforeach value="8" id="blog" type="checkbox" class="filled-in" name="section[8]">
                  <label for="blog" class="material-checkbox"></label>
                </div>
                {{__('Blog')}}
              </label> 
              <br/>

              <label>
                <div class="inline">
                  <input @foreach($menu->menusections as $section) @if($section->section_id == 9)  checked="checked" @endif @endforeach value="9" id="upcoming" type="checkbox" class="filled-in" name="section[9]">
                  <label for="upcoming" class="material-checkbox"></label>
                </div>
                {{__('Upcoming Movie')}}
              </label>
              
                <br> 
                <label>
                  <div class="inline">
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 10)  checked="checked" @endif @endforeach value="10" id="liveevent" type="checkbox" class="filled-in" name="section[10]">
                    <label for="liveevent" class="material-checkbox"></label>
                  </div>
                  {{__('LiveEvent')}}
                </label> 
                <br/> 

                 <label>
                  <div class="inline">
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 11)  checked="checked" @endif @endforeach value="11" id="audio" type="checkbox" class="filled-in" name="section[11]">
                    <label for="audio" class="material-checkbox"></label>
                  </div>
                  {{__('Audio')}}
                </label> 
                <br/> 
                @if($topsection == 1)
                 <label>
                  <div class="inline">
                    <input @foreach($menu->menusections as $section) @if($section->section_id == 12)  checked="checked" @endif @endforeach value="12" id="topRated" type="checkbox" class="filled-in" name="section[12]">
                    <label for="topRated" class="material-checkbox"></label>
                  </div>
                  {{__('TopRated Section')}}
                </label> 
                <br/>  
                @endif         
           
                <small class="text-danger">{{ $errors->first('section') }}</small>
            </div>
            @else
               <div class="form-group" class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
              <label>{{__('ChooseSection')}}: <span class="text-danger">*</span></label>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('MenuWillContainFollowingSection')}}</small>
              <br>
               <small class="text-muted"> <i class="fa fa-question-circle"></i> {{__('AtleaseOneSectionIsRequired')}}</small>

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
                    <label for="Select Genre">Select Genre</label> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select these genre you want to show on home page"></i><br/>
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
               <div style="display: none" class="section3">
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

                  <div class="form-group">
                    <label>{{__('Order In')}}:</label>
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
                      <option value="1">{{__('Slider View')}}</option>
                      <option value="0">{{__('Grid View')}}</option>
                    </select>
                  </div>

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
                  <input value="7" id="parmotion" type="checkbox" class="filled-in" name="section[7]">
                  <label for="parmotion" class="material-checkbox"></label>
                </div>
                {{__('Movie Tvseries Pramotion')}}
              </label>

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
                {{__('Upcoming Movie')}}
              </label>
               
              <br/>
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
              <br/>
              @if($topsection == 1)
               <label>
                <div class="inline">
                  <input value="12" id="topRated" type="checkbox" class="filled-in" name="section[12]">
                  <label for="topRated" class="material-checkbox"></label>
                </div>
                {{__('Top Rated Section')}}
              </label>
              @endif
                <small class="text-danger">{{ $errors->first('section') }}</small>
            </div>
            @endif
             
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

      $('#upcoming').on('change',function(){
          if($(this).is(':checked')){
            $('.section9').show('fast');
          }else{
            $('.section9').hide('fast');
          }
      });

     
   
  </script>
@endsection
