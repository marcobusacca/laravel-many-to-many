@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Index Title -->
            <div class="col-6 d-flex justify-content-start align-items-end my-5">
                <h1>Tipologie dei Progetti</h1>
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
            <!-- Types Infos Table -->
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
                        @foreach ($types as $type)
                            <tr class="text-center">
                                <!-- Type Id -->
                                <td>{{ $type->id }}</td>
                                <!-- Type Name -->
                                <td>{{ $type->name }}</td>
                                <!-- Type Slug -->
                                <td>{{ $type->slug }}</td>
                                <!-- Type Tools -->
                                <td>
                                    <!-- Type Show Button -->
                                    <a href="{{ route('admin.types.show', $type) }}" class="btn btn-info mx-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Type Edit Button -->
                                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Type Delete Button -->
                                    <form class="type-delete-button d-inline-block mx-1" data-type-name="{{ $type->name }}" action="{{ route('admin.types.destroy', $type) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Type Create Button -->
                        <tr class="text-center">
                            <td colspan="4" class="py-4">
                                <a href="{{ route('admin.types.create') }}" class="text-decoration-none">Crea una Nuova Tipologia</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.partials.modal_type_delete');
@endsection