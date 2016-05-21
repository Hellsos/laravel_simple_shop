@extends('layouts.app')

@section('content')

<style>
    .leftCol {
        text-align: right;
        padding-right: 20px;
    }
    
    .midCol {
        padding-right: 20px;
    }
    
    .rightCol {
        opacity: 0.6;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Warning</div>
                <div class="panel-body">
                    You need to be an Admin!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
