@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Companies
                </div>
                <div class="card-body">
                    <edit
                         items="{{$company}}"
                    >
                    </edit>
                </div>
                {{$company->name}}
            </div>
        </div>
    </div>
</div>

@endsection
