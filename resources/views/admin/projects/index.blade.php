@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Index Title -->
            <div class="col-6 d-flex justify-content-start align-items-end my-5">
                <h1>I nostri Progetti</h1>
            </div>
            <!-- Link To Dashboard -->
            <div class="col-6 d-flex justify-content-end align-items-end my-5">
                <a href="{{ Route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a>
            </div>
            <!-- Delete Confirm Message -->
            @if (session('message'))
                <div class="col-12 mt-5">
                    <div class="alert alert-success">
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            @endif
            <!-- Projects Infos Table -->
            <div class="col-12">
                <table class="table table-striped border">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date of Creation</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="text-center">
                                <!-- Project Id -->
                                <td>{{ $project->id }}</td>
                                <!-- Project Title -->
                                <td>{{ $project->title }}</td>
                                <!-- Project Date of Creation -->
                                <td>{{ $project->date_of_creation }}</td>
                                <!-- Project Tools -->
                                <td>
                                    <!-- Project Show Button -->
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info mx-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Project Edit Button -->
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Project Delete Button -->
                                    <form class="project-delete-button d-inline-block mx-1" data-project-title="{{ $project->title }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Project Create Button -->
                        <tr class="text-center">
                            <td colspan="4" class="py-4">
                                <a href="{{ route('admin.projects.create') }}" class="text-decoration-none">Crea un Nuovo Progetto</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.partials.modal_project_delete');
@endsection