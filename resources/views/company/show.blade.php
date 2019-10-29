@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Company: {{$company->name}}
                </div>
                <div class="card-body">
                    <p>Email: {{$company->email}}</p>
                    <p>Adress: {{$company->address}}</p>
                    <p>Website: {{$company->email}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
