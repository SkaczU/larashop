@extends('layouts.app')

@section('content')
    <div class="container-fluid"> <!-- Użyj container-fluid zamiast container -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Lista Usług</h1>
        </div>
        <hr />
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nazwa usługi</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Dostępność</th> <!-- Zamknięcie poprzedniego tagu th -->
                    <th>Zamów</th>
                </tr>
            </thead>
            <tbody>
                @if($service->count() > 0)
                    @foreach($service as $rs)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->name }}</td>
                            <td class="align-middle">{{ $rs->description }}</td> 
                            <td class="align-middle">{{ $rs->price }}</td>
                            <td class="align-middle">{{ $rs->available }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('services.show', $rs->id) }}" type="button" class="btn btn-secondary">Dodaj do koszyka</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">Brak dostępnych usług</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection