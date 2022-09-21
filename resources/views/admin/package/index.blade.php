@extends('layouts.admin')
@section('title',__('All Packages'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('package.create')
        <a href="{{route('packages.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Package')}}</a>
      @endcan
      <!-- Delete Modal -->

      @can('package.delete')
        <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>
      @endcan
      <!-- Modal -->
      <p class="info">{{__('DragAnDrop')}}</p>
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
              {!! Form::open(['method' => 'POST', 'action' => 'PackageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body content-block-two">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row ">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('Package Name')}}</th>
            <th>{{__('Amount')}}</th>
            <th>{{__('Interval')}}</th>
            <th>{{__('Interval Count')}}</th>
            <th>{{__('Trail Period')}}</th>
            <th>{{__('Status')}}</th>
           
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
        @if ($packages)
          <tbody id="sortable">
            @foreach ($packages as $key => $package)
           {{--  @if($package->delete_status == 1) --}}

              <tr  class="sortable row1" data-id="{{ $package->id }}">
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$package->id}}" id="checkbox{{$package->id}}">
                    <label for="checkbox{{$package->id}}" class="material-checkbox"></label>
                  </div>
                  {{$key+1}}
                </td>
                <td>{{$package->name}}</td>
                <td>@if($package->amount != '0.00') <i class="{{$package->currency_symbol}}"></i>{{$package->amount}} @else Free @endif</td>
                <td>{{$package->interval}}</td>
                <td>{{$package->interval_count}}</td>
                <td>{{$package->trial_period_days}}</td>
                <td>
                    <form action="{{ route('pkgstatus',$package->id) }}" method="POST">
                      {{ csrf_field() }}
                    @if($package->status == 'active' || $package->status == 'upcoming')
                    <input type="hidden" value="inactive" name="status">
                    <button type="submit" class="btn btn-sm btn-danger">{{__('Deactive')}}</button>
                    @else
                    <input type="hidden" value="active" name="status">
                    <button type="submit" class="btn btn-sm btn-success">{{__('Active')}}</button>
                    @endif
                    </form>
                </td>
                <td>
                  <div class="admin-table-action-block">
                    
                    @if($package->delete_status == 1)
                      @can('package.edit')
                      <a data-toggle="tooltip" data-original-title="{{__('Restore Package')}}" style="cursor: not-allowed" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      @endcan
                      {{-- <a href="{{route('pricing.text', $package->id)}}" data-toggle="tooltip" data-original-title="{{__('PackageFeature')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a> --}}
                      @can('package.delete')
                        <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$package->id}}deleteModal"><i class="material-icons">delete</i> </button>
                      @endcan
                    @else
                      @can('package.edit')
                      <a href="{{route('packages.edit', $package->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      
                      <button data-toggle="modal" data-target="#deleteModal{{$package->id}}" class="btn-danger btn-floating"><i class="material-icons">restore_from_trash</i></button>
                      @endcan
                    @endif
                   
                  </div>
                </td>
              </tr>
              {{-- @endif --}}
              <!-- Delete Modal -->
              <div id="deleteModal{{$package->id }}" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
                      <p class="text-danger">{{__('Do you really want to delete these records then all related data also deleted ? This process cannot be undone. ')}}</p>
                      {{-- <p>{{__('DeleteWarrning')}}</p> --}}
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="{{route("packages.destroy", $package->id)}}">
                        @method("DELETE")
                        @csrf
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Soft Delete Modal -->
              <div id="{{$package->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                      {!! Form::open(['method' => 'DELETE', 'action' => ['PackageController@softDelete', $package->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                          <input type="submit" class="btn btn-danger" value="{{__('Yes')}}">
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
    $(function() {
      $('#cb3').change(function() {
        $('#status').val(+ $(this).prop('checked'))
      })
    })
  </script>

<script>
    
    var sorturl = {!!json_encode(route('package_reposition'))!!};

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
