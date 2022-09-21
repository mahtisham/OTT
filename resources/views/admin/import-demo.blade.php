@extends('layouts.admin')
@section('title',__('Import Demo'))
@section('content')
    <div class="admin-form-main-block mrg-t-40">
        <h4 class="admin-form-text">
            {{__('Import Demo')}}
        </h4>
        <div class="content-block box-body">
            <div class="admin-form-block z-depth-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-danger">
                            <i class="fa fa-info-circle"></i> {{__('Important Note')}}:

                            <ul>
                                <li>
                                    {{__("ON Click of import data your existing data like Movies,Tvseries, and Package etc will remove except users,settings.")}}
                                </li>

                                <li>
                                    {{__("ON Click of reset data will reset your site (which you see after fresh install).")}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <form action="{{ url('/admin/import/import-demo') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    {{__("One Click Demo Import")}}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-offset-1 col-md-3">
                        <form action="{{ url('/admin/reset-demo') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">
                                    {{__("Reset Demo")}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection