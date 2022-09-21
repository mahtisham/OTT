@extends('layouts.admin')
@section('title',__('All Slider'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('home_slider.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Add Slide')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
              <p>{{__('Delete Selected')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'HomeSliderController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="info">{{__('Drag An Drop')}}</p>
    <div class="content-block box-body content-block-two">
      <table id="full_detail_table" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            #
          </th>
          <th>{{__('Movie')}}</th>
          <th>{{__('Tv Series')}}</th>
          <th>{{__('Slide Image')}}</th>
          <th>{{__('Active')}}</th>
          <th>{{__('Actions')}}</th>
        </tr>
        </thead>
        @if ($home_slides)
          <tbody id="sortable">
          @foreach ($home_slides as $key => $home_slide)
            <tr class="sortable row1" data-id="{{ $home_slide->id }}">
              <td>
                <div class="inline">
                  <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$home_slide->id}}" id="checkbox{{$home_slide->id}}">
                  <label for="checkbox{{$home_slide->id}}" class="material-checkbox"></label>
                </div>
                <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                {{$key+1}}
              </td>
              <td>{{$home_slide->movie ? $home_slide->movie->title : '-'}}</td>
              <td>{{$home_slide->tvseries ? $home_slide->tvseries->title : '-'}}</td>
              <td>
                @if(isset($home_slide->slide_image))
                  @if(isset($home_slide->movie) && $home_slide->movie_id != NULL)
                    @if ($home_slide->movie != null && $home_slide->movie_id != NULL)
                      <img src="{{asset('images/home_slider/movies/'. $home_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($home_slide->movie->poster != null)
                      <img src="{{asset('images/movies/posters/'. $home_slide->movie->poster)}}" class="img-responsive" alt="slider-image">
                    @endif
                  @elseif(isset($home_slide->tvseries)&& $home_slide->tv_series_id != NULL)
                    @if ($home_slide->slide_image != null)
                      <img src="{{asset('images/home_slider/shows/'. $home_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($home_slide->tvseries['poster'] != null)
                      <img src="{{asset('images/tvseries/posters/'. $home_slide->tvseries['poster'])}}" class="img-responsive" alt="slider-image">
                    @endif
                  @else
                    @if($home_slide->slide_image != null)
                      <img src="{{asset('images/home_slider/'. $home_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @endif
                  @endif
                @endif
              </td>
              <td>{{$home_slide->active == 1 ? __('Active') : __('inactive')}}</td>
              <td>
                <div class="admin-table-action-block">
                  <a href="{{route('home_slider.edit', $home_slide->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                  <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$home_slide->id}}deleteModal"><i class="material-icons">delete</i> </button>
                </div>
              </td>
            </tr>
            <!-- Delete Modal -->
            <div id="{{$home_slide->id}}deleteModal" class="delete-modal modal fade" role="dialog">
              <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="delete-icon"></div>
                  </div>
                  <div class="modal-body text-center">
                    <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
                    <p>{{__('Delete Warrning')}}</p>
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['HomeSliderController@destroy', $home_slide->id]]) !!}
                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                        <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
<script>
 
  var sorturl = {!!json_encode(route('slide_reposition'))!!};

</script>
<script>
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });

  $( "#full_detail_table" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
        sendOrderToServer();
    }
  });

  function sendOrderToServer() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    $('tr.row1').each(function(index,element) {
      order.push({
        id: $(this).attr('data-id'),
        position: index+1
      });
    });
    $.ajax({
      type: "POST", 
      dataType: "json", 
      url: sorturl,
      data: {
          order: order,
        _token: token
      },
      success: function(response) {
          if (response.status == "success") {
            console.log(response);
          } else {
            console.log(response);
          }
      }
    });
  }
  
</script>
@endsection