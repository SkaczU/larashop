@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Lista Usług</h1>
        </div>
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nazwa usługi</th>
                    <th>Opis</th>
                    <th>Cena</th>
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
                            @if($rs->available == 1)
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="" type="button" class="btn btn-secondary">Dodaj do koszyka</a>
                                </div>
                            </td>
                            @else
                            <td>
                            Usługa Narazie niedostępna
                            </td>
                            @endif
                        </tr>
                    @endforeach    
                @else
                    <tr>
                        <td class="text-center" colspan="5">Brak dostępnych usług</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mb-0 row align-items-center">
            {{ $service->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection