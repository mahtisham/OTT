@extends('layouts.admin')
@section('title',__('Backup Manager'))
@section('content')

<div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('Backup Manager Settinges')}}</h4><br/>
    <div class="admin-form-block z-depth-1">
        <form action="{{route('admin.backup.path')}}" method="POST" class="form-group">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="BINARY_PATH">{{__('MysqlDumpPath')}}</label>
                         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Mysql BinaryPath')}} eg: /usr/bin/mysql/mysql-5.7.24-winx64/bin"></i>
                        <input type="text" name="BINARY_PATH" value="{{env('BINARY_PATH') ? env('BINARY_PATH') : ''}}" placeholder="/usr/bin/mysql/mysql-5.7.24-winx64/bin">

                        <small class="text-danger">
                            <b>{{__('Note')}}:-</b><br/>
                            •{{__('Note1 Mysql')}}<br/>
                            • {{__('Note2 Mysql')}}<br/>
                            • {{__('Note3 Mysql')}}<br/>
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success btn-md">{{__('Update')}}</button>
                </div>
            </div>
            

        </form>
        
        <div class="row">
            <div class="col-md-8">
                <ul>
                    <li>
                        {{ __('Generate Backup Text') }}
                    </li>

                    <li>
                        <b>{{ __('Download Sql List') }}</b>
                    </li>

                    <li>
                       {{__('Make Sure')}} <b>{{__('Mysql Enable')}}</b> {{__('Mysql Note Description')}}
                        <b>{{__('Mysql Note File Name')}}</b>.
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <br>
                @if(env('BINARY_PATH') != NULL)
                <a href="{{ url('admin/backups/process?type=onlydb') }}" class="btn btn-md btn-success">
                    <i class="fa fa-refresh"></i> {{ __('Generate Database Backup') }}
                </a>
                @endif
            </div>
        </div>
         <div class="row">
            <div class="text-center col-md-8">
                {!! $html !!}
            </div>
            @if(env('BINARY_PATH') != NULL)
            <div class="col-md-4">
                <div class="well">
                    <p class="text-muted"> <b>{{__('Download The Latest Backup')}}</b> </p>
                    
                    @php

                        $dir17 = storage_path() . '/app/'.config('app.name');
                    @endphp
                       
                        <ul>

                            @foreach (array_reverse(glob("$dir17/*")) as $key=> $file) 
                        
                                @if($loop->first)
                                    <li><a href="{{ URL::temporarySignedRoute('admin.backup.download', now()->addMinutes(1), ['filename' => basename($file)]) }}"><b>{{ basename($file)  }} ({{__('Latest')}})</b></a></li> 
                                @else
                                    <li><a href="{{ URL::temporarySignedRoute('admin.backup.download', now()->addMinutes(1), ['filename' => basename($file)]) }}">{{ basename($file)  }}</a></li> 
                                @endif
                         
                            @endforeach 

                        </ul>
                        
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection