@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="card-title">Logowanie</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 row align-items-center">
                            <label for="email" class="col-md-4 col-form-label text-md-start"><b>Adres email</b></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="przykladowy@mail.com" required>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="password" class="col-md-4 col-form-label text-md-start"><b>Hasło</b></label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Logowanie</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection