@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div>
                        Ciao {{ $user->name }}
                    </div>

                    <div>
                        Ti sei loggatato con la mail: {{ $user->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
