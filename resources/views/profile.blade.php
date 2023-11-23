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
                        <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="">
                            @csrf
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
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
                                <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                                <div class="col-md-8">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
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
