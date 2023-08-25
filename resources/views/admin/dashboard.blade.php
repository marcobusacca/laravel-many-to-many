@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-12 text-center my-5">
            <a href="{{ Route('admin.projects.index') }}" class="btn btn-primary mx-3">Progetti</a>
            <a href="{{ Route('admin.types.index') }}" class="btn btn-primary mx-3">Tipologie</a>
            <a href="{{ Route('admin.technologies.index') }}" class="btn btn-primary mx-3">Tecnologie</a>
        </div>
    </div>
</div>
@endsection
