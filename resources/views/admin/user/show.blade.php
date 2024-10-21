@extends('adminlte::page')

@php
 
@endphp

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Pengguna </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href=" ">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Pengguna</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="mt-4 m-2">
    <div class="row">
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-body">
                    woke
                    {{$user->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
