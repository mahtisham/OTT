@extends('layouts.admin')
@section('title','Static Words | ')
@section('content')
<div class="content-main-block mrg-t-40">
    
    <div class="content-block box-body content-block-two">

         <table id="roletable" class="table table-hover db">
            <thead>
              <tr class="table-heading-row">
                <th class="text-center">{{__('#')}}</th>
                <th class="text-center">{{__('Local')}}</th>
                <th class="text-center">{{__('Name')}}</th>
                <th class="text-center">{{__('Front Static Words')}}</th>
                <th class="text-center">{{__('Admin Static Words')}}</th>
              </tr>
            </thead>
           
            <tbody>
              @foreach($langs as $key => $lang)
              <tr>
              <td class="text-center">{{$key+1}}</td>
              <td class="text-center">{{$lang->local}}</td>
              <td class="text-center">{{$lang->name}}</td>
              <td class="text-center">
                <a class="btn btn-info" href="{{url('/admin/translation/'.$lang->local.'')}}"> <i class="fa fa-pencil"></i></a>
              </td>
              <td class="text-center">
                <a class="btn btn-info" href="{{url('/admin/adminstatic/'.$lang->local.'')}}"> <i class="fa fa-pencil"></i></a>
              </td>
              </tr>
              @endforeach
            </tbody>
            
        </table>
       
@endsection
@section('custom-script')
    
@endsection