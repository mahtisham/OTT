@extends('layouts.admin')
@section('title',__('Create a new role'))
@section('content')

  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{route('roles.index')}}" data-toggle="tooltip" data-original-title="{{__('GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Create a new role')}}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="admin-form-block z-depth-1">


                <form action="{{ route('roles.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                          <label for="name"  class="text-dark">Role name <span class="text-red">*</span></label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter role name" value="{{ old('name') }}" required autofocus>

                        <input type="hidden" name="guard" value="web">

                        @error('name')
                            <span class="text-red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        

                        <p class="text-dark"> <b>{{ __('Assign Permissions to role') }}</b> </p>
                       
                        <table class="permissionTable table table-bordered">
                            <th>
                                {{__('Section')}}
                            </th>
                            <th>
                                <!--<label>
                                    <input type="checkbox" class="grand_selectall filled-in" name="section[1]">{{__('Select All') }}
                                    <label for="select" class="material-checkbox"></label>
                                </label>-->

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="grand_selectall custom-control-input" id= "select" name="section[1]">
                                    <label class="custom-control-label" for="select">{{__('Select All') }}</label>
                                </div>

                            </th>

                            <th>
                                {{__("Available permissions")}}
                            </th>


                           
                            <tbody>
                            @if(isset($custom_permission))
                               @foreach($custom_permission as $key => $group)
                                <tr>
                                    <td>
                                        <b>{{ ucfirst($key) }}</b>
                                    </td>
                                    <td width="30%">
                                        <!--<label>
                                            <input class="selectall" type="checkbox">
                                            <label for="select" class="material-checkbox"></label>
                                            {{__('Select All') }}
                                        </label>-->
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="selectall" id="selectall{{ ucfirst($key) }}" name="example1">
                                            <label class="custom-control-label" for="selectall{{ ucfirst($key) }}">{{__('Select All') }}</label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                        @forelse($group as $permission)

                                           <!--<label>
                                               <input name="permissions[]" class="permissioncheckbox" type="checkbox" value="{{ $permission->id }}">
                                               <label for="select" class="material-checkbox"></label>
                                               {{$permission->name}} &nbsp;&nbsp;
                                           </label>-->

                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="permissioncheckbox" id="customCheck{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                            <label class="custom-control-label" for="customCheck{{ $permission->id }}">{{$permission->name}} &nbsp;&nbsp;</label>
                                        </div>

                                        @empty
                                            {{ __("No permission in this group !") }}
                                        @endforelse

                                    </td>

                                </tr>
                               @endforeach
                               @endif
                            </tbody>
                        </table>

                    </div>

                    <div class="form-group btn-group">
                        <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
                         <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Create')}}</button>
                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


       
@endsection
@section('custom-script')
    <script src="{{ url('/js/checkbox.js') }}"></script>
@endsection