@extends('layouts.admin')
@section('title',__('Menu Section Shorting'))
@section('content')
    <div class="content-main-block mrg-t-40">
    <h5>{{__('Menu Section Shorting')}}</h5><br/>
    <p class="info">{{__('DragAnDrop')}}</p>
        <div class="content-block box-body content-block-two">
            <div>
                <!-- Nav tabs -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                @foreach ($menus as $key => $menu)
                    <li role="presentation"><a href="#menu-{{$menu->slug}}" aria-controls="{{$menu->name}}" role="tab" data-toggle="tab">{{$menu->name}}</a></li>
                @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                @foreach ($menus as $key => $menu)

                    <div role="tabpanel" class="tab-pane fade table-responsive" id="menu-{{$menu->slug}}">
                        <br>
                
                    <table id="drag_drop_{{$menu->slug}}" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"><b>#</b></th>
                                <th class="text-center"><b>{{__('Position')}}</b></th>
                                <th class="text-center"><b>{{__('Menu Section')}}</b></th>
                            </tr>
                        </thead>
                            @foreach($menu->menu_sections as $section)
                            <tbody id="sortable">
                            <tr class="sortable row1" data-id="{{ $section->id }}" >
                                <td>{{$section->id}}</td>
                                <td>{{$section->position}}</td>

                                @if($section->section_id == 1)
                                    <td>{{__('Recently Added')}}</td>
                                @elseif($section->section_id == 2)
                                    <td>{{__('Genre')}}</td>
                                @elseif($section->section_id == 3)
                                    <td>{{__('Featured')}}</td>
                                @elseif($section->section_id == 4)
                                    <td>{{__('Best of Intrest')}}</td>
                                @elseif($section->section_id == 5)
                                    <td>{{__('Continue Watch')}}</td>
                                @elseif($section->section_id == 6)
                                    <td>{{__('Languages')}}</td>
                                @elseif($section->section_id == 7)
                                    <td>{{__('Short Promo')}}</td>
                                @elseif($section->section_id == 8)
                                    <td>{{__('Blog')}}</td>
                                @elseif($section->section_id == 9)
                                    <td>{{__('Upcoming Movies')}}</td>
                                @elseif($section->section_id == 10)
                                    <td>{{__('Live Event')}}</td>
                                @elseif($section->section_id == 11)
                                    <td>{{__('Audio')}}</td>
                                @elseif($section->section_id == 12)
                                    <td>{{__('TopRated Section')}}</td>
                                @endif
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    </div>
                @endforeach
                    
                    
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

    <script>
        $(function() {
        $('#cb3').change(function() {
            $('#is_active').val(+ $(this).prop('checked'))
        })
        })
    </script>
    <script>
    
    var sorturl = {!!json_encode(route('menu_section_reposition'))!!};

    </script>

@foreach ($menus as $key => $menu)
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

    $( "#drag_drop_{{$menu->slug}}" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
        sendOrderToServer();
    }
    });

    $( "#drag_drop_kids" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
        sendOrderToServer();
    }
    });

    function sendOrderToServer() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    $('tr.row1').each(function(index,element) {
        order.push({
        id: $(this).attr('data-id'),
        position: index+1
        });
    });
    $.ajax({
        type: "POST", 
        dataType: "json", 
        url: sorturl,
        data: {
            order: order,
        _token: token
        },
        success: function(response) {
            if (response.status == "success") {
            console.log(response);
            } else {
            console.log(response);
            }
        }
    });
    }
        
    </script>
    
@endforeach
@endsection