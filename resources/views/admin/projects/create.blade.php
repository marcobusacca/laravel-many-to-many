@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Create Title -->
            <div class="col-6 d-flex justify-content-start align-items-end mt-5">
                <h1>Crea un Nuovo Progetto</h1>
            </div>
            <!-- Link To Projects List -->
            <div class="col-6 d-flex justify-content-end align-items-end mt-5">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Lista Progetti</a>
            </div>
            <!-- Create Form -->
            <div class="col-12 my-5">
                <form action="{{ route('admin.projects.store') }}" method="POST" class="border p-3 w-100" enctype="multipart/form-data">
                    @csrf
                    <!-- Project Title Form Group -->
                    <div class="form-group my-4">
                        <!-- Title Label -->
                        <label class="control-label my-2">Titolo:</label>
                        <!-- Title Input Text -->
                        <input type="text" name="title" id="title" placeholder="Inserisci il Titolo del Progetto" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        <!-- Title Error Text -->
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Project Description Form Group -->
                    <div class="form-group my-4">
                        <!-- Description Label -->
                        <label class="control-label my-2">Descrizione:</label>
                        <!-- Description TextArea -->
                        <textarea name="description" id="description" placeholder="Inserisci la Descrizione del Progetto" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" required>{{ old('description') }}</textarea>
                        <!-- Description Error Text -->
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Project Date of Creation Form Group -->
                    <div class="form-group my-4">
                        <!-- Date of Creation Label -->
                        <label class="control-label my-2">Data di Creazione:</label>
                        <!-- Date of Creation Input Date -->
                        <input type="date" name="date_of_creation" id="date_of_creation" class="form-control @error('date_of_creation') is-invalid @enderror" value="{{ old('date_of_creation') }}" required>
                        <!-- Date of Creation Error Text -->
                        @error('date_of_creation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Project Type Form Group -->
                    <div class="form-group my-4">
                        <!-- Type Label -->
                        <label class="control-label my-2">Tipologia:</label>
                        <!-- Type Select -->
                        <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" value="">
                            <option value="">Seleziona una Tipologia</option>
                            @foreach ($types as $type)
                                <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <!-- Type Error Text -->
                        @error('type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Project Technologies Form Group -->
                    <div class="form-group my-4">
                        <span>Seleziona le Tecnologie:</span>
                        @foreach ($technologies as $technology)
                            <div class="my-2">
                                <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : ''}} class="form-check-input @error('technologies') is-invalid @enderror">
                                <label class="form-check-label">{{ $technology->name }}</label>
                            </div>
                        @endforeach
                        <!-- Technologies Error Text -->
                        @error('technologies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Project Cover Image Form Group -->
                    <div class="form-group my-4">
                        <!-- Cover Image Label -->
                        <label class="control-label my-2">Copertina:</label>
                        <!-- Cover Image Input File -->
                        <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                        <!-- Cover Image Error Text -->
                        @error('cover_image')
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