@extends('layouts.admin')
@section('title',__('Fake View'))
@section('content')
    <div class="content-main-block mrg-t-40">
        <div class="content-block box-body content-block-two">
            <div>
                <!-- Nav tabs -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{__('Movies')}}</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{__('TVShows')}}</a></li>
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade table-responsive in active" id="home">
                        <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>{{__('MovieName')}}</th>
                                <th>{{__('Views')}}</th>
                                <th>{{__('Fake Views')}}</th>
                                <th>{{__('Total Views')}}</th>
                                <th>{{__('Add Fake Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($movies as $key => $movie)
                                
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $movie->title }}</td>
                                <td><i class="fa fa-eye"></i> {{ views($movie)
                                    ->unique()
                                    ->count()}}</td>
                                <td><i class="fa fa-eye"></i>{{ $movie->views }}</td>   
                                <td><i class="fa fa-eye"></i> {{ views($movie)
                                    ->unique()
                                    ->count() + $movie->views }}</td>
                                <td><a href="{{url('/admin/fakeViews/'.$movie->id.'/edit')}}"> <i class="btn btn-sm btn-success">Add View</i></a></td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade table-responsive" id="profile">
                        <br>
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Tv Series Name')}}</th>
                                <th>{{__('Views')}}</th>
                                <th>{{__('Fake Views')}}</th>
                                <th>{{__('Total Views')}}</th>
                                <th>{{__('Add Fake Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                @foreach ($season as $key => $s)
                                
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $s->tvseries['title'] }} [Season: {{ $s->season_no }}]</td>
                                    <td><i class="fa fa-eye"></i> {{ views($s)
                                        ->unique()
                                        ->count() }}</td>
                                    <td><i class="fa fa-eye"></i>{{$s->views}}
                                    <td><i class="fa fa-eye"></i> {{ views($s)
                                        ->unique()
                                        ->count() + $s->views }}</td>
                    <td><a href="{{url('/admin/fakeSeasonViews/'.$s->id.'/edit')}}"> <i class="btn btn-sm btn-success">Add View</i></a></td>
                                </tr>

                                @endforeach
                        </tbody>
                    </table> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function(){

            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endsection