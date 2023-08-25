@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Project Title -->
            <div class="col-6 d-flex justify-content-start align-items-end my-5">
                <h1>{{ $project->title }}</h1>
            </div>
            <!-- Link To Projects List -->
            <div class="col-6 d-flex justify-content-end align-items-end my-5">
                <a href="{{ Route('admin.projects.index') }}" class="btn btn-primary">Lista Progetti</a>
            </div>
            <!-- Create, Edit Confirm Message -->
            @if (session('message'))
                <div class="col-12 mt-5">
                    <div class="alert alert-success">
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            @endif
            <div class="col-12 mb-5">
                <!-- Show Card -->
                <div class="card w-100">
                    <div class="card-body">
                        <!-- Project Description -->
                        <div class="my-5">
                            <!-- Description Label -->
                            <label class="fw-bold">Descrizione:</label>
                            <!-- Description Content -->
                            <p class="py-2">{{ $project->description }}</p>
                        </div>
                        <!-- Project Date of Creation -->
                        <div class="my-5">
                            <!-- Date of Creation Label -->
                            <label class="fw-bold">Data di Creazione:</label>
                            <!-- Date of Creation Content -->
                            <h6 class="d-inline-block">{{ $project->date_of_creation }}</h6>
                        </div>
                        <!-- Project Type -->
                        <div class="my-5">
                            @if (empty($project->type->name))
                                <span>Tipologia non disponibile</span>
                            @else
                                <!-- Type Label -->
                                <label class="fw-bold">Tipologia:</label>
                                <!-- Type Content -->
                                <a href="{{ route('admin.types.show', $project->type) }}" class="btn btn-sm btn-primary mx-1">{{ $project->type->name }}</a>
                            @endif
                        </div>
                        <!-- Project Technologies -->
                        <div class="my-5">
                            @if (count($project->technologies) == 0)
                                <span>Tecnologia non disponibile</span>
                            @else
                                <!-- Technologies Label -->
                                @if (count($project->technologies) == 1)
                                    <label class="fw-bold">Tecnologia:</label>
                                @else
                                    <label class="fw-bold">Tecnologie:</label>
                                @endif
                                <!-- List of Technologies -->
                                @foreach ($project->technologies as $technology)
                                    <a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-sm btn-primary mx-1">{{ $technology->name }}</a>
                                @endforeach
                            @endif
                        </div>
                        <!-- Project Cover Image -->
                        <div class="my-5">
                            @if (empty($project->cover_image))
                                <span>Immagine non disponibile</span>
                            @else
                                <div class="text-center">
                                    <!-- Cover Image -->
                                    <img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}-cover-image">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection