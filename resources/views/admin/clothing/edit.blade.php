@extends('adminlte::page')

@section('title')
    Detail Model Baju
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Model Baju </h1>
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
                <form action="{{ route('clothing.update', $clothing) }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- EDIT FIELD --}}
                            <div class="form-group">
                                <label for="clothingName">Nama Model</label>
                                <input type="text" class="form-control @error('clothingName') is-invalid @enderror"
                                    id="clothingName"
                                    value="@if (old('clothingName')) {{ old('clothingName') }} @else {{ $clothing->name }} @endif"
                                    name="clothingName" placeholder="Baju Bagus">
                                @error('clothingName')
                                    <div id="inpNameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="clothingDescription">Deskripsi</label>
                                <textarea class="form-control @error('clothingDescription') is-invalid @enderror " name="clothingDescription"
                                    id="clothingDescription" cols="10" rows="5">
@if (old('clothingDescription'))
{{ old('clothingDescription') }}@else{{ $clothing->description }}
@endif
</textarea>
                                @error('clothingDescription')
                                    <div id="clothingDescriptionFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="genderType">Tipe Pakaian</label>
                                <select class="form-control @error('genderType') is-invalid @enderror" name="genderType"
                                    id="genderType">
                                    <option value="" @if (!old('genderType')) selected @endif>
                                        Pilih Tipe
                                        Pakaian
                                    </option>
                                    <option value="1" @if (old('genderType') == 1 || $clothing->genderType == 1) selected @endif>Pria
                                    </option>
                                    <option value="2" @if (old('genderType') == 2 || $clothing->genderType == 2) selected @endif>Wanita
                                    </option>
                                    <option value="3" @if (old('genderType') == 3 || $clothing->genderType == 3) selected @endif>Unisex</option>
                                </select>
                                @error('genderType')
                                    <div id="genderTypeFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Galeri</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-responsive table-hover">
                            <tbody>
                                @foreach ($clothing->getPreviewImageFullPaths() as $path)
                                    <tr class="mb-2">
                                        <td class="col-6">
                                            <img class="img " style=" width: 100%; height: 200px; object-fit: cover;"
                                                src="{{ $path }}" alt="Image" style="height: 200px">
                    </div>
                    <td class="col-6">
                        <form action="{{ route('clothing.preview.delete', $clothing) }}" method="post">
                            @csrf
                            <input type="hidden" name="imgPath" value="{{ $path }}">
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                                Hapus Gambar
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>

                    <br>
                    <span class="h4 mb-2">Tambah Gambar</span>
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
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                                    </div>
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
                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100" aria-valuenow="0">
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
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{-- Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin. --}}
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">File FBX</h3>
                </div>
                <div class="card-body">
                    @if (!$clothing->fbxFilePath)
                        <span class="h5 mb-2">Upload File</span> 
                        <form action="">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"  class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    @else
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
@endsection

@push('css')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script>
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{ route('clothing.preview.add', ['clothing' => $clothing]) }}", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            acceptedFiles: '.jpeg, .jpg, .png',
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}")
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
    </script>
@endpush
