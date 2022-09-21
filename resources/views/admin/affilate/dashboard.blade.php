@extends('layouts.admin')
@section('title','Affiliate Reports')
@section('content')
<div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
        <h5>{{__('Affiliate Reports')}}</h5>
    </div>

    <div class="content-block box-body content-block-two">
        <table id="affiliate_report" class="table table-hover db">
            <thead>
                <tr class="table-heading-row">
                    <th>
                        #
                    </th>
                
                    <th>
                        {{__('Refered user')}}
                    </th>
                    <th>
                        {{__('Refered by')}}
                    </th>
                    <th>
                        {{__('Amount')}}
                    </th>
               
                    <th>
                        {{__('Date')}}
                    </th>
                </tr>
                   
            </thead>
            <tbody>
        
            </tbody>
        </table>
    </div>
</div>

{{-- <div class="admin-form-main-block mrg-t-40">
    <div class="contentbar"> 
        <div class="row">
            
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-title">Affiliate Reports</h5>
                    </div>
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="report" class="table table-bordered">
                                <thead>
                                    <th>
                                        #
                                    </th>
                                
                                    <th>
                                        Refered user
                                    </th>
                                    <th>
                                        Refered by
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                </thead>
                                <tbody>
                    
                                </tbody>
                                <tfoot align="right">
                                    <tr>
                                        <th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('custom-script')
<script>

    $(function () {
        "use strict";
        var table = $('#affiliate_report').DataTable({
            processing: true,
            serverSide: true,
           
            responsive: true,
            autoWidth: false,
            scrollCollapse: true,
            ajax: '{{ route("admin.affilate.dashboard") }}',
            language: {
                searchPlaceholder: "Search in reports..."
            },
            columns: [
                {data: 'DT_RowIndex', name: 'affilate_histories.id', searchable : false},
                {data : 'refered_user', name : 'fromRefered.name'},
                {data : 'user', name : 'user.name'},
                {data : 'amount', name : 'affilate_histories.amount'},
                {data : 'created_at', name : 'affilate_histories.created_at'},
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace("{{ $currency_symbol }}", '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var grandtotal = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 3).footer() ).html('Total');
                    $( api.column( 4 ).footer() ).html("{{ $currency_symbol }}"+'<p>'+grandtotal.toFixed(2)+'</p>');
                },
            
            dom : 'lBfrtip',
            buttons : [
                'csv','excel','pdf','print'
            ],
            order : [[0,'desc']]
        });
        
    });

</script>  
@endsection
