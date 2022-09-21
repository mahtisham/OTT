@extends('layouts.admin')
@section('title',__('View Track'))
@section('content')
    <div class="content-main-block mrg-t-40">
        <div class="content-block box-body content-block-two">
            <div>
                <!-- Nav tabs -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{__('Movies')}}</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{__('TV Shows')}}</a></li>
                    <li role="presentation"><a href="#weeklym" aria-controls="profile" role="tab" data-toggle="tab">{{__(' Weekly Top 10 Movies')}}</a></li>
                    <li role="presentation"><a href="#weeklys" aria-controls="profile" role="tab" data-toggle="tab">{{__(' Weekly Top 10 Tv-Shows')}}</a></li>
                    <li role="presentation"><a href="#monthlym" aria-controls="profile" role="tab" data-toggle="tab">{{__(' Monthly Top 10 Movies')}}</a></li>
                    <li role="presentation"><a href="#monthlys" aria-controls="profile" role="tab" data-toggle="tab">{{__(' Monthly Top 10 Tv-Shows')}}</a></li>

                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane fade table-responsive in active" id="home">
                        <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>{{__('Movie Name')}}</th>
                                <th>{{__('Views')}}</th>
                                
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
                                </tr>

                                @endforeach
                        </tbody>
                    </table> 
                    </div>

                    <div role="tabpanel" class="tab-pane fade table-responsive" id="weeklym">
                        <br>
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Movie Name')}}</th>
                                <th>{{__('Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($movieslw as $key => $mw)
                                
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mw->title }}</td>
                                <td><i class="fa fa-eye"></i> {{ views($mw)
                                    ->unique()
                                    ->count()}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table> 
                    </div>

                    <div role="tabpanel" class="tab-pane fade table-responsive" id="weeklys">
                        <br>
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Tv Series Name')}}</th>
                                <th>{{__('Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                @foreach ($seasonlw as $key => $sw)
                                
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $sw->tvseries['title'] }} [Season: {{ $sw->season_no }}]</td>
                                    <td><i class="fa fa-eye"></i> {{ views($sw)
                                        ->unique()
                                        ->count() }}</td>
                                </tr>

                                @endforeach
                        </tbody>
                    </table> 
                    </div>

                    <div role="tabpanel" class="tab-pane fade table-responsive" id="monthlym">
                        <br>
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('MovieName')}}</th>
                                <th>{{__('Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($movieslm as $key => $mm)
                                
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $mm->title }}</td>
                                <td><i class="fa fa-eye"></i> {{ views($mm)
                                    ->unique()
                                    ->count()}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table> 
                    </div>

                    <div role="tabpanel" class="tab-pane fade table-responsive" id="monthlys">
                        <br>
                        <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Tv Series Name')}}</th>
                                <th>{{__('Views')}}</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                                @foreach ($seasonlm as $key => $sm)
                                
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $sm->tvseries['title'] }} [Season: {{ $sm->season_no }}]</td>
                                    <td><i class="fa fa-eye"></i> {{ views($sm)
                                        ->unique()
                                        ->count() }}</td>
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