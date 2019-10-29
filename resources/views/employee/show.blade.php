@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Employee: {{$employee->first_name}} {{$employee->last_name}}
                </div>
                <div class="card-body">
                    <p>Email: {{$employee->email}}</p>
                    <p>Phone: {{$employee->phone}}</p>
                    <p>Company: {{$employee->company_id}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
