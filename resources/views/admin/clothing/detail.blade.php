@extends('adminlte::page')

@section('title')
    Detail Model Baju
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Model Baju </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href=" ">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Model Baju</li>
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
                    <div class="card-header">
                        <div class="card-tools d-flex flex-row">
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#modalHapus">
                                <i class="fas fa-trash"></i>
                                Hapus
                            </button>
                            <a href="{{ route('clothing.edit', $clothing) }}" class="btn btn-sm btn-warning ml-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <table class="table table-borderless ">
                                    <tr>
                                        <th class="col-4">Nama</th>
                                        <td>{{ $clothing->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $clothing->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipe Pakaian</th>
                                        <td>{{ $clothing->getGenderTypeName() }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4">
                                {{-- <img class="img img-fluid" src="{{ $pasien->user->getAvatar() }}" alt=""> --}}
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Galeri</h3>
                    </div>
                    <div class="card-body">
                        <div id="carouselExampleControls" class="carousel slide p-4" data-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $first = true;
                                @endphp
                                @foreach ($clothing->getPreviewImageFullPaths() as $path)
                                    <div class="carousel-item @if ($first) active @endif">
                                        <img class="d-block w-100 img img-fluid" src="{{ $path }}" alt="First slide"
                                            style="max-height: 300pt; object-fit: cover;">
                                    </div>
                                    @php
                                        $first = false;
                                    @endphp
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin. --}}
                    </div>
                </div>

            </div>
        </div>

        {{-- FBX --}}
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">File FBX</h3>
                    </div>
                    <div class="card-body">
                        @if ($clothing->fbxFilePath)
                        <div class="mb-1">
                            <span class="badge badge-info">
                                File sudah ada
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                        @else
                        <div class="mb-1">
                            <span class="badge badge-warning">
                                <i class="fas fa-times"></i>
                                File belum ada
                            </span>
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin. --}}
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
                    <form action="{{route('clothing.delete', $clothing)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Model Baju</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script></script>
@endpush
