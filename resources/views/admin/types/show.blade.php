@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Type Name -->
            <div class="col-6 d-flex justify-content-start align-items-end my-5">
                <h1>{{ $type->name }}</h1>
            </div>
            <!-- Link To Types List -->
            <div class="col-6 d-flex justify-content-end align-items-end my-5">
                <a href="{{ Route('admin.types.index') }}" class="btn btn-primary">Lista Tipologie</a>
            </div>
            <!-- Create, Edit Confirm Message -->
            @if (session('message'))
                <div class="col-12 mt-5">
                    <div class="alert alert-success">
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <!-- Show Card -->
                <div class="card w-100">
                    <div class="card-body">
                        <!-- Type Slug -->
                        <div class="my-5 text-center">
                            <!-- Slug Label -->
                            <label class="fw-bold">Slug:</label>
                            <!-- Slug Content -->
                            <span class="d-inline-block">{{ $type->slug }}</span>
                        </div>
                        <!-- Type Projects -->
                        <div class="my-5 text-center">
                            @if (count($type->projects) == 0)
                                <span>Nessun Progetto appartenente a questa Tipologia</span>
                            @else
                                <!-- Projects Label -->
                                <label class="fw-bold">Progetti di questa Tipologia:</label>
                                <!-- List of Projects -->
                                @foreach ($type->projects as $project)
                                    <span>{{ $project->title }},</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection