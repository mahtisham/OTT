@extends('layouts.admin')
@section('title','Currency')
@section('content')
<div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
        <a href="{{route('currency.index')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn btn-default btn-floating"><i class="material-icons">reply</i></a> {{__('Checkout Payment Method')}}
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="content-block box-body content-block-two">
        
                <form action="{{route('checkout.payment.method')}}" method="POST">
                    @csrf
                    <input type="hidden" name="currecny_id" value="{{$currency->id}}">
                    <div class="col-sm-4 form-group text-center">
                        <label for="">{{__('Currency')}}</label>
                        <h5 class="text-center">{{$currency->code}}</h5>
                    </div>
                    <div class="col-sm-8 form-group">
                        <label for="">
                            {{__('Payment Method')}}:
                        </label>

                        
                        <select name="payment_method[]" id="" class="select2" multiple>
                            @foreach($payments as $payment)
                              
                                <option value="{{$payment}}" 
                                    @if(isset($currency->payment_method) && $currency->payment_method != NULL)
                                        {{ in_array($payment,$currency_payments) ? "selected" : "" }}
                                    @endif >
                                    {{ ucfirst($payment) }}
                                </option>
                                   
                            @endforeach
                        </select>
                    </div> 
                    <div class="btn-group pull-right">
                        <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
                        <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Save')}}</button>
                    </div>
                    <div class="clear-both"></div>
            
                </form>
            </div>
        </div>
    </div>
</div>
@endsection