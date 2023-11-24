@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Moje zamówienia</h1>
        </div>
        <hr />
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Zamówienie</th>
                    <th>Z dnia</th>
                    <th>Status</th>
                    <th>Podgląd</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $rs)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">Zamówienie nr {{ $rs->id }}</td>
                            <td class="align-middle">{{ $rs->created_at }}</td> 
                            <td class="align-middle">{{ $rs->status }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="./services{{$rs->id}}" type="button" class="btn btn-secondary">Podglad</a>
                                </div>
                            </td>
                        </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">Brak Zamówień</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mb-0 row align-items-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection