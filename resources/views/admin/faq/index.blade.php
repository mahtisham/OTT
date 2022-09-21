@extends('layouts.admin')
@section('title',__('All FAQs'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('faq.create')
        <a href="{{route('faqs.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create FAQ')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('faq.delete')
        <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
      @endcan
      <!-- Modal -->
      <p class="info">{{__('Drag An Drop')}}</p>
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
              {!! Form::open(['method' => 'POST', 'action' => 'FaqController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive content-block-two">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('Faq Question')}}</th>
            <th>{{__('Faq Answer')}}</th>
            <th>{{__('Created At')}}</th>
            <th>{{__('Updated At')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
        @if ($faqs)
          <tbody id="sortable">
            @php ($no = 1)
            @foreach ($faqs as $faq)
              <tr class="sortable row1" data-id="{{ $faq->id }}" >
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$faq->id}}" id="checkbox{{$faq->id}}">
                    <label for="checkbox{{$faq->id}}" class="material-checkbox"></label>
                  </div>
                  {{$no}}
                  @php ($no++)
                </td>
                <td>{!! $faq->question !!}</td>
                <td>{!! $faq->answer !!}</td>
                <td>{{date('F d, Y',strtotime($faq->created_at))}}</td>
                <td>{{date('F d, Y',strtotime($faq->updated_at))}}</td>
                
                <td>
                  <div class="admin-table-action-block">
                    @can('faq.edit')
                      <a href="{{route('faqs.edit', $faq->id)}}" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    @endcan
                    @can('faq.delete')
                      <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$faq->id}}deleteModal"><i class="material-icons">delete</i> </button>
                    @endcan
                  </div>
                </td>

              </tr>
              <!-- Delete Modal -->
              <div id="{{$faq->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                      {!! Form::open(['method' => 'DELETE', 'action' => ['FaqController@destroy', $faq->id]]) !!}
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
  </script>

<script>
    
    var sorturl = {!!json_encode(route('faqs_reposition'))!!};

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