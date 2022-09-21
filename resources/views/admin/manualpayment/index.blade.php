@extends('layouts.admin')
@section('title','Manual Payment Gateway')
@section('body')
@component('components.box',['border' => 'with-border'])
@slot('header')

@section('content')
<div class="admin-form-main-block mrg-t-40">
    <div class="row admin-form-block z-depth-1">   
        <div class="pull-right">
            @can('manual-payment.create')
            <a data-toggle="modal" data-target="#addPaymentModal" href="" class="btn btn-md btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>
            @endcan

        </div>

        <table style="width:100%" id="full_detail_table" class="table table-bordered">
            <thead>
                <th>
                    #
                </th>
                <th>
                    {{__('Payment Gateway Name')}}
                </th>
                <th>
                    {{__('Action')}}
                </th>
            </thead>
            <tbody>
                @foreach($methods as $key=> $m)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{  ucfirst($m->payment_name) }}</td>
                    <td>
                       @can('manual-payment.edit')
                        <a data-toggle="modal" data-target="#editPaymentmethod{{ $m->id }}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i>
                        </a>
                        @endcan
                       @can('manual-payment.delete')
                        <a data-toggle="modal" data-target="#deletepaymentmethod{{ $m->id }}"  class="btn-danger btn-floating"><i class="material-icons">delete</i>
                        </a>
                        @endcan
                        
                    </td>
                </tr>

                <!-- Edit Payment Method Modal -->
                <div data-backdrop="false" id="editPaymentmethod{{ $m->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="editPaymentModal-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="editPaymentModal-title">{{__('Edit Payment method')}}: {{ $m->payment_name }}
                                </h5>

                            </div>
                            <div class="modal-body">
                                <form action="{{ route('manual.payment.gateway.update',$m->id) }}" method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <label for="">
                                            {{__('Payment method name')}}: <span class="text-red">*</span>
                                        </label>
                                        <input required type="text" value="{{ $m['payment_name'] }}" name="payment_name" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">
                                            {{__('Payment Instructions')}} : <span class="text-red">*</span>
                                        </label>

                                        <textarea name="description" id="" cols="30" rows="5" class="form-control editor">{!! $m['description'] !!}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label for="">
                                            {{__('Image')}} :
                                        </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>

                                   
                                        <div class="bootstrap-checkbox form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                          <div class="row">
                                            <div class="col-md-7">
                                              <h5 class="bootstrap-switch-label">{{__('Status')}}</h5>
                                            </div>
                                            <div class="col-md-5 pad-0">
                                              <div class="make-switch">
                                                {!! Form::checkbox('status', 1, ($m->status == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                                                
                                              </div>
                                            </div>
                                          </div>
                                        
                                        </div>
                                   
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-success">
                                            <i class="fa fa-save"></i> {{__('Update')}}
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Delete Payment -->
                <div id="deletepaymentmethod{{ $m->id }}" class="delete-modal modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                                <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                <p>{{__('Do you really want to delete this Payment method')}} <b>{{ $m->payment_name }}</b>{{__('? This process
                                    cannot be undone.')}}</p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{ route('manual.payment.gateway.delete',$m->id) }}"
                                    class="pull-right">
                                    @csrf
                                    @method('delete')
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->

                @endforeach
            </tbody>
        </table>

        <!-- Create Payment Method Modal -->
        <div data-backdrop="false" id="addPaymentModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="addPaymentModal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="addPaymentModal-title">{{__('Add new payment method')}}</h5>

                    </div>
                    <div class="modal-body">
                        <form action="{{ route('manual.payment.gateway.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label for="">
                                    {{__('Payment method name')}}: <span class="text-red">*</span>
                                </label>
                                <input required type="text" value="{{ old('payment_name') }}" name="payment_name"
                                    class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="">
                                   {{__(' Payment Instructions')}} : <span class="text-red">*</span>
                                </label>

                                <textarea name="description" id="" cols="30" rows="5"
                                    class="form-control editor">{!! old('description') !!}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="">
                                    {{__('Image')}} :
                                </label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>

                            <div class="form-group">
                                <label class="col-md-5 bootstrap-switch-label">{{__('Status')}} :</label>
                                <label class="make-switch col-md-7 pad-0">
                                    <input class="bootswitch" id="status" type="checkbox" name="status" {{ old('status') ? "checked" : "" }}>
                                    
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success">
                                    <i class="fa fa-plus-circle"></i> {{__('Create')}}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection