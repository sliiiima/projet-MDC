@extends('layout.app')
@section('mini title', 'Import')
@section('content')
    <div class="container mt-5">
        <h2>Upload Excel File</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="excel_file">Select Excel File</label>
                <input type="file"
                       name="excel_file"
                       id="excel_file"
                       class="form-control @error('excel_file') is-invalid @enderror"
                       accept=".xlsx, .xls">
                @error('excel_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload and Import</button>
        </form>
    </div>


@endsection
