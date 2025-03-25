@extends('layout.template')

@section('title', 'Details User')

@section('contents')
    <div class="card">
        <div class="card-header">
            <p class="fs-5 my-0">User Details Data</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">ID</p>
                        <p class="my-0">{{ $user->user_id }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">Username</p>
                        <p class="my-0">{{ $user->username }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">Name</p>
                        <p class="my-0">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="d-flex flex-column gap-1">
                        <p class="fs-5 my-0">Level</p>
                        <p class="my-0">{{ $user->level->level_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
               
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush