@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Index Title -->
            <div class="col-6 d-flex justify-content-start align-items-end my-5">
                <h1>Tecnologie dei Progetti</h1>
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
            <!-- Technologies Infos Table -->
            <div class="col-12">
                <table class="table table-striped border">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr class="text-center">
                                <!-- Technology Id -->
                                <td>{{ $technology->id }}</td>
                                <!-- Technology Name -->
                                <td>{{ $technology->name }}</td>
                                <!-- Technology Slug -->
                                <td>{{ $technology->slug }}</td>
                                <!-- Technology Tools -->
                                <td>
                                    <!-- Technology Show Button -->
                                    <a href="{{ route('admin.technologies.show', $technology) }}" class="btn btn-info mx-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Technology Edit Button -->
                                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Technology Delete Button -->
                                    <form class="technology-delete-button d-inline-block mx-1" data-technology-name="{{ $technology->name }}" action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Technology Create Button -->
                        <tr class="text-center">
                            <td colspan="4" class="py-4">
                                <a href="{{ route('admin.technologies.create') }}" class="text-decoration-none">Crea una Nuova Tecnologia</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.partials.modal_technology_delete');
@endsection