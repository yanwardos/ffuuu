@extends('adminlte::page')

@section('title')
    Tambah Model Baju
@endsection

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Model Baju </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href=" ">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Model Baju</li>
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
                    <form action="{{ route('clothing.store') }}" method="post">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="clothingName">Nama Model</label>
                                <input type="text" class="form-control @error('clothingName') is-invalid @enderror"
                                    id="clothingName"
                                    value="@if (old('clothingName')) {{ old('clothingName') }} @endif"
                                    name="clothingName" placeholder="Baju Bagus">
                                @error('clothingName')
                                    <div id="inpNameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="clothingDescription">Deskripsi</label>
                                <textarea class="form-control @error('clothingDescription') is-invalid @enderror " name="clothingDescription" id="clothingDescription" cols="10" rows="5">@if (old('clothingDescription')){{old('clothingDescription')}}@endif</textarea>
                                @error('clothingDescription')
                                    <div id="clothingDescriptionFeedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="genderType">Tipe Pakaian</label>
                                <select class="form-control @error('genderType') is-invalid @enderror" name="genderType" id="genderType"> 
                                    <option value="" @if (!old('genderType')) selected @endif>Pilih Tipe Pakaian</option>  
                                    <option value="1" @if (old('genderType')==1) selected @endif>Laki-laki</option>
                                    <option value="2" @if (old('genderType')==2) selected @endif>Perempuan</option>
                                    <option value="3" @if (old('genderType')==3) selected @endif>Unisex</option>
                                </select>
                                @error('genderType')
                                    <div id="genderTypeFeedback" class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
