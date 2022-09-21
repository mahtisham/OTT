@extends('layouts.admin')
@section('title',__('All Addvertisments'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('banneradd.create')
        <a href="{{route('banneradd.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Post')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('banneradd.delete')
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
      @endcan
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
              {!! Form::open(['method' => 'POST', 'action' => 'BlogController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      
      <div class="row">
        @if(isset($banneradd) && $banneradd->count() > 0)
        @foreach($banneradd as $item)
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">
            <div class="card-two card">
              @if($item->image != NULL)
              <img src="{{url('/images/banneradd/' . $item->image)}}" class="card-img-top" alt="...">
              @else
              <img src="{{Avatar::create($item->title)->toBase64()}}" class="card-img-top" alt="...">
              @endif
              <div class="overlay-bg"></div>
              <div class="dropdown card-dropdown">
                <a class="btn-default btn-floating pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons left">more_vert</i>
                </a>
                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                
                  @can('banneradd.edit')
                    <a class="dropdown-item" href="{{ route('blog.edit', $item->id)}}"><i class="material-icons">mode_edit</i> {{__('Edit')}}</a>
                  @endcan
                
                  @can('banneradd.delete')
                  
                    <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> {{__('Delete')}}</a>
                    
                  @endcan
                 
                </div>
              </div>
              <div id="deleteModal{{$item->id}}" class="delete-modal modal fade" role="dialog">
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
                      <form method="POST" action="{{route("banneradd.destroy", $item->id)}}">
                        @method('DELETE')
                        @csrf
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Link')}}</h6>
                  <p>{!! isset($item->link) && $item->link != NULL ? str_limit($item->link,100) : '-' !!}</p>
                </div>
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                  @if($item->is_active == 1)
                    <p>{{__('Active')}}</p>
                  @else
                    <p>{{__('De Active')}}</p>
                  @endif
                </div>
                <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Column')}}</h6>
                  @if($item->column == 1)
                    <p>{{__('One Column')}}</p>
                  @else
                    <p>{{__('Two Column')}}</p>
                  @endif
                </div>
                {{-- <div class="card-block">
                  <h6 class="card-body-sub-heading">{{__('Blog Emotions')}}</h6>
                  <div class="card-icons">
                    <ul>
                      <li>
                          <a href="{{url('account/blog/', $item->slug)}}" data-toggle="tooltip" data-original-title=" Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                      </li>
                      @can('blog.edit')
                        <li>
                          <a href="{{route('blog.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                      @endcan
                      @can('blog.delete')
                        <li>
                          <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> </a>
                          <div id="deleteModal{{$item->id}}" class="delete-modal modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                  <h4 class="modal-heading">{{__('AreYouSure')}}</h4>
                                  <p>{{__('DeleteWarrning')}}</p>
                                </div>
                                <div class="modal-footer">
                                  <form method="POST" action="{{route("blog.destroy", $item->id)}}">
                                    @method('DELETE')
                                    @csrf
                                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      @endcan
                    </ul>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        @endforeach
        <div class="col-md-12 pagination-block text-center">
           {!! $banneradd->appends(request()->query())->links() !!}
        </div>
      @else
        <div class="col-md-12 text-center">
          <h5>{{__("Let's start :)")}}</h5>
          <small>{{__('Get Started by creating a actor! All of your actors will be displayed on this page.')}}<a href=""></a></small>
        </div>
      @endif
      </div>
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

@endsection