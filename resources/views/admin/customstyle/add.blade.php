@extends('layouts.admin')
@section('title',__('Custom Style Settings'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('Custom Style Settings')}}</h4>
    <div class="form-group{{ $errors->has('css') ? ' has-error' : '' }}">
    <form action="{{ route('css.store') }}" method="POST">
      {{ csrf_field() }}
    <label for="css">{{__('Custom CSS:')}}</label>
    <small class="text-danger">{{ $errors->first('css','CSS Cannot be blank !') }}</small>
    <textarea placeholder="a {
      color:red;
    }" id="he" class="form-control" name="css" rows="10" cols="30">{{ $css }}</textarea>

    <input type="submit" value="{{__('ADD Css')}}" class="btn btn-md btn-primary">
    </form>
    </div>
    <br>
    <div class="form-group{{ $errors->has('js') ? ' has-error' : '' }}">
    <form action="{{ route('js.store') }}" method="POST">
      {{ csrf_field() }}
    <label for="js">{{__('Custom JS:')}}</label>
    <small class="text-danger">{{ $errors->first('js','Javascript Cannot be blank !') }}</small>
    <textarea placeholder="$(document).ready(function{
      //code
  });" class="form-control" name="js" rows="10" cols="30">{{$js}}</textarea>

    <input type="submit" value="{{__('ADD JS')}}" class="btn btn-md btn-primary">
    </form>
    </div>
  </div>
@endsection
