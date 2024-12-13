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
                        <div class="card-tools">
                            <a href="{{route('clothing.edit', $clothing)}}" class="btn btn-warning">
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
                        {{-- <div id="carouselGalery" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($clothing->getPreviewImageFullPaths() as $path) 
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://placehold.co/600x400" alt="First slide">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselGalery" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselGalery" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div> --}}
                        <div id="carouselExampleControls" class="carousel slide p-4" data-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $first = true
                                @endphp
                                @foreach ($clothing->getPreviewImageFullPaths() as $path) 
                                    <div class="carousel-item @if($first) active @endif">
                                        <img class="d-block w-100 img img-fluid" src="{{$path}}" alt="First slide" style="max-height: 300pt; object-fit: cover;">
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
{{-- 
                        <div id="actions" class="row">
                            <div class="col-lg-6">
                                <div class="btn-group w-100">
                                    <span class="btn btn-success col fileinput-button">
                                        <i class="fas fa-plus"></i>
                                        <span>Add files</span>
                                    </span>
                                    <button type="submit" class="btn btn-primary col start">
                                        <i class="fas fa-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning col cancel">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="fileupload-process w-100">
                                    <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                            data-dz-uploadprogress></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table table-striped files" id="previews">
                            <div id="template" class="row mt-2">
                                <div class="col-auto">
                                    <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <p class="mb-0">
                                        <span class="lead" data-dz-name></span>
                                        (<span data-dz-size></span>)
                                    </p>
                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="progress progress-striped active w-100" role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                            data-dz-uploadprogress></div>
                                    </div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary start">
                                            <i class="fas fa-upload"></i>
                                            <span>Start</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-warning cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Cancel</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-danger delete">
                                            <i class="fas fa-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin. --}}
                    </div>
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
    <script>
        // Dropzone.autoDiscover = false

        // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        // var previewNode = document.querySelector("#template")
        // previewNode.id = ""
        // var previewTemplate = previewNode.parentNode.innerHTML
        // previewNode.parentNode.removeChild(previewNode)

        // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        //     url: "{{ route('clothing.preview.add', ['clothing' => $clothing]) }}", // Set the url
        //     thumbnailWidth: 80,
        //     thumbnailHeight: 80,
        //     parallelUploads: 20,
        //     acceptedFiles: '.jpeg, .jpg, .png',
        //     previewTemplate: previewTemplate,
        //     autoQueue: false, // Make sure the files aren't queued until manually added
        //     previewsContainer: "#previews", // Define the container to display the previews
        //     clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        // })

        // myDropzone.on("addedfile", function(file) {
        //     // Hookup the start button
        //     file.previewElement.querySelector(".start").onclick = function() {
        //         myDropzone.enqueueFile(file)
        //     }
        // })

        // // Update the total progress bar
        // myDropzone.on("totaluploadprogress", function(progress) {
        //     document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        // })

        // myDropzone.on("sending", function(file, xhr, formData) {
        //     formData.append("_token", "{{ csrf_token() }}")
        //     // Show the total progress bar when upload starts
        //     document.querySelector("#total-progress").style.opacity = "1"
        //     // And disable the start button
        //     file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        // })

        // // Hide the total progress bar when nothing's uploading anymore
        // myDropzone.on("queuecomplete", function(progress) {
        //     document.querySelector("#total-progress").style.opacity = "0"
        // })

        // // Setup the buttons for all transfers
        // // The "add files" button doesn't need to be setup because the config
        // // `clickable` has already been specified.
        // document.querySelector("#actions .start").onclick = function() {
        //     myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        // }
        // document.querySelector("#actions .cancel").onclick = function() {
        //     myDropzone.removeAllFiles(true)
        // }
    </script>
@endpush
