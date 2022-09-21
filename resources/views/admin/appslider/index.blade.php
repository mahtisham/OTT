@extends('layouts.admin')
@section('title',__('App Slider'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('appslider.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Add App Slide')}}</a>
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
              <p>{{__('Delete Warrning')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'AppSliderController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="info">{{__('Drag And Drop')}}</p>
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
          <th>{{__('Tv-Series')}}</th>
          <th>{{__('App Slide Image')}}</th>
          <th>{{__('Status')}}</th>
          <th>{{__('Actions')}}</th>
        </tr>
        </thead>
        @if ($app_slides)
          <tbody id="sortable">
          @foreach ($app_slides as $key => $app_slide)
            <tr class="row1 sortable" data-id="{{$app_slide->id}}">
              <td>
                <div class="inline">
                  <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$app_slide->id}}" id="checkbox{{$app_slide->id}}">
                  <label for="checkbox{{$app_slide->id}}" class="material-checkbox"></label>
                </div>
                <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                {{$key+1}}
              </td>
              <td>{{$app_slide->movie ? $app_slide->movie->title : '-'}}</td>
              <td>{{$app_slide->tvseries ? $app_slide->tvseries->title : '-'}}</td>
              <td>
                @if(isset($app_slide->slide_image))
                  @if($app_slide->movie && $app_slide->movie_id != NULL )
                    @if ($app_slide->slide_image != null)
                      <img src="{{asset('images/app_slider/movies/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($app_slide->movie->poster != null)
                      <img src="{{asset('images/movies/posters/'. $app_slide->movie->poster)}}" class="img-responsive" alt="slider-image">
                    @endif
                  @elseif(isset($app_slide->tvseries) && $app_slide->tv_series_id != NULL)
                    @if ($app_slide->slide_image != null)
                      <img src="{{asset('images/app_slider/shows/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                    @elseif ($app_slide->tvseries['poster'] != null)
                      <img src="{{asset('images/tvseries/posters/'. $app_slide->tvseries['poster'])}}" class="img-responsive" alt="slider-image">
                    @endif
                  @else
                      @if ($app_slide->slide_image != null)
                        <img src="{{asset('images/app_slider/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                      @endif
                  
                  @endif
                
                @endif
              </td>
              <td>{{$app_slide->active == 1 ? __('Active') : __('Deactive')}}</td>
              <td>
                <div class="admin-table-action-block">
                  <a href="{{route('appslider.edit', $app_slide->id)}}" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                  <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$app_slide->id}}deleteModal"><i class="material-icons">delete</i> </button>
                </div>
              </td>
            </tr>
            <!-- Delete Modal -->
            <div id="{{$app_slide->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AppSliderController@destroy', $app_slide->id]]) !!}
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
 
  var sorturl = {!!json_encode(route('app_slide_reposition'))!!};

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