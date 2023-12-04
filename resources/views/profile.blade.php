@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title">Edycja Profilu</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile', ['id' => auth()->user()->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nazwa</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" placeholder="First name" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-8">
                                    <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="voivodeship" class="col-md-4 col-form-label text-md-end font-weight-bold">Województwo</label>
                                <div class="col-md-8">
                                    <select name="voivodeship" class="form-control" id="voivodeship" required>
                                        @foreach([
                                            'dolnośląskie', 'kujawsko-pomorskie', 'lubelskie', 'lubuskie', 'łódzkie',
                                            'małopolskie', 'mazowieckie', 'opolskie', 'podkarpackie', 'podlaskie',
                                            'pomorskie', 'śląskie', 'świętokrzyskie', 'warmińsko-mazurskie',
                                            'wielkopolskie', 'zachodniopomorskie'
                                        ] as $voivodeship)
                                            <option value="{{ $voivodeship }}" {{ auth()->user()->voivodeship == $voivodeship ? 'selected' : '' }}>{{ $voivodeship }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="shoe_size" class="col-md-4 col-form-label text-md-end">Numer buta</label>
                                
                                <div class="col-md-4">
                                    <input type="number" name="shoe_size" class="form-control" id="shoe_size" value="{{ auth()->user()->shoe_size }}" min="20" max="70">
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button id="btn" class="btn btn-primary btn-lg" type="submit">Zapisz zmiany</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
