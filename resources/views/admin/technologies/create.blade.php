@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Create Title -->
            <div class="col-6 d-flex justify-content-start align-items-end mt-5">
                <h1>Crea una Nuova Tecnologia</h1>
            </div>
            <!-- Link To Technologies List -->
            <div class="col-6 d-flex justify-content-end align-items-end mt-5">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">Lista Tecnologie</a>
            </div>
            <!-- Create Form -->
            <div class="col-12 my-5">
                <form action="{{ route('admin.technologies.store') }}" method="POST" class="border p-3 w-100" enctype="multipart/form-data">
                    @csrf
                    <!-- Technology Name Form Group -->
                    <div class="form-group my-4">
                        <!-- Name Label -->
                        <label class="control-label my-2">Nome:</label>
                        <!-- Name Input Text -->
                        <input type="text" name="name" id="name" placeholder="Inserisci il Nome della Tecnologia" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        <!-- Name Error Text -->
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Create Submit Button -->
                    <div class="col-12 d-flex justify-content-center align-items-center my-5">
                        <button class="btn btn-success fw-bold px-5" type="submit">CREA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection