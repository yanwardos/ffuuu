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
                    @php
                        $no = 0;
                    @endphp
                    <x-adminlte-datatable id="table1" :heads="[['label'=>'No', 'width'=>5], 'Name', ['label' => 'Email', 'width' => 30], ['label' => 'Actions', 'no-export' => true, 'width' => 25 ]]">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    <a href="{{ route('user.show', ['id'=>$user->id]) }}" class="btn btn-xs p-1 btn-default text-teal mr-1 mb-1 shadow" title="Details">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                        Detail
                                    </a>
                                    <a href="{{ route('user.edit', ['id'=>$user->id]) }}" class="btn btn-xs p-1 btn-default text-primary mr-1 mb-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                        Ubah
                                    </a>
                                    <button href="{{ route('user.delete', ['id'=>$user->id]) }}" class="btn btn-xs p-1 btn-default text-danger mr-1 mb-1 shadow" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach 
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
