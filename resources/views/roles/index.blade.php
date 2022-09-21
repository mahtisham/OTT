@extends('layouts.admin')
@section('title','Roles | ')
@section('content')
<div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{ route('roles.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create a new role')}}</a>
    
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
              {!! Form::open(['method' => 'POST', 'action' => 'MenuController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body content-block-two">

         <table id="roletable" class="table table-hover db">
            <thead>
              <tr class="table-heading-row">
                <th class="text-center">{{__('#')}}</th>
                <th class="text-center">{{__('Role Name')}}</th>
                <th class="text-center">{{__('Action')}}</th>
              </tr>
            </thead>
           
            <tbody>
              @foreach($roles as $key => $role)
              <tr>
              <td class="text-center">{{$key+1}}</td>
              <td class="text-center">{{$role->name}}</td>
              <td class="text-center">
                @if(($role->id == 1) || ($role->id == 2) || ($role->id == 3))
                  <h6 style="color:#a94442;"><b>System reserved role</b></h6>
              @else
                <a class="btn btn-info" href="{{url('/admin/roles/'.$role->id.'/edit')}}"> <i class="fa fa-pencil"></i></a>
                <a onclick="return confirm ('Are you sure you want to delete?')" class="btn btn-danger" 
                href="{{url('/admin/roles/'.$role->id.'/delete')}}"><i class="fa fa-trash"></i></a>
                
              @endif
              </td>
              </tr>
              @endforeach
            </tbody>
            
        </table>
       
@endsection
@section('custom-script')
    
@endsection