@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->prodi }}</p>
                            <p class="card-text">{{ $user->bidangminat }}</p>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection