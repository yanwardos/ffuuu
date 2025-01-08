@extends('adminlte::page')

@php

@endphp

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Model Baju </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href=" ">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Model Baju</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="mt-4 m-2">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @php
                            $no = 1;
                        @endphp
                        <x-adminlte-datatable id="table1" :heads="[
                            ['label' => 'No', 'width' => 5],
                            'Nama Desain',
                            ['label' => 'Tipe Baju', 'width' => 15],
                            ['label' => 'Deskripsi', 'width' => 30],
                            ['label' => 'Actions', 'no-export' => true, 'width' => 20],
                        ]">
                            @foreach ($clothings as $clothing)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        {{ $clothing->name }}
                                    </td>
                                    <td>
                                        {{ $clothing->getGenderTypeName() }}
                                    </td>
                                    <td>
                                        {{ $clothing->description }}
                                    </td>
                                    <td>
                                        <a href="{{ route('clothing.show', ['clothing' => $clothing]) }}"
                                            class="btn btn-xs p-1 btn-default text-teal mr-1 mb-1 shadow" title="Details">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="{{ route('clothing.edit', ['clothing' => $clothing]) }}"
                                            class="btn btn-xs p-1 btn-default text-primary mr-1 mb-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                            Ubah
                                        </a> 
                                        <button type="button" class="btn btn-xs p-1 btn-default text-danger mr-1 mb-1 shadow" data-toggle="modal"
                                            data-target="#modalHapus"
                                            onclick="deleteClothing(this)"
                                            clothing-id="{{$clothing->id}}"
                                            clothing-name="{{$clothing->name}}"
                                            >
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                        {{-- <form action="{{ route('clothing.delete', $clothing) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-xs p-1 btn-default text-danger mr-1 mb-1 shadow">
                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                                Hapus Model Baju</button>
                                        </form> --}}
                                        @if (!$clothing->getFbxFilePaths())
                                            <span class="badge bg-warning mb-1">Belum memiliki file model .fbx</span>
                                        @endif
                                        @if (!$clothing->getPreviewImagePaths())
                                            <span class="badge bg-warning mb-1">Belum memiliki file gambar preview</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Model Baju?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda akan menghapus model baju?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form id="formDelete" action="{{route('clothing.delete', $clothing)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Model Baju</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var deleteClothing = (target) => {
            console.log($('#formDelete').attr('action'));
            
        }
    </script>
@endpush
