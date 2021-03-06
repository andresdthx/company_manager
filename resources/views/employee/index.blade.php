@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Companies
                </div>
                <div class="card-body">

                    <index-employee
                        :employees="{{$employees}}"
                        :companies="{{$companies}}"
                        :roles="{{$roles}}"
                    ></index-employee>

                    <div class="center-block">{{$paginateEmployees}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
