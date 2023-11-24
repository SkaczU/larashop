@extends('layouts.app')

@section('content')
    <div class="container">
        @if($order->order_items->isNotEmpty())
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Twoje usługi</h1>
        </div>
        <hr />

            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Usługa</th>
                        <th>Data Rozpoczecia</th>
                        <th>Data Zakończenia</th>
                        <th>Przejdz do</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_items as $services)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $services->service->name }}</td>
                            <td class="align-middle">{{ $services->start_date }}</td> 
                            <td class="align-middle">{{ $services->end_date }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="/services/{{$services  ->id}}" type="button" class="btn btn-secondary">Podglad</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Brak zamówionych usług.</p>
        @endif
    </div>
@endsection