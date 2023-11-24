@extends('layouts.app')

@section('content')
    <div class="container">
        @if($order->order_items->isNotEmpty())
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Zamówienie nr {{$order->id}} - Status: {{$order->status}}</h1>
        </div>
        <hr />

            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Usługa</th>
                        <th>Czas trwania w Miesącach</th>
                        <th>Data Rozpoczecia</th>
                        <th>Data Zakończenia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_items as $order_item)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $order_item->service->name }}</td>
                            <td class="align-middle">{{ $order_item->quantity }} </td>
                            <td class="align-middle">{{ $order_item->start_date }}</td> 
                            <td class="align-middle">{{ $order_item->end_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="mb-0">Całkowity koszt zamowienia: {{$order->value}}</h1>
            </div>
        @else
            <p>Brak zamówionych usług.</p>
        @endif
    </div>
@endsection