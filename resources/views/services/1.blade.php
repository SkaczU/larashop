@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">{{$service->name}}</h1>
        </div>
        @if($orderItems->isEmpty())
        <p>Brak Dostępu do usługi</p>
         @else
        <div class="row justify-content-center">
            @php
                $endDates = $orderItems->pluck('end_date')->toArray();
                $maxEndDate = max($endDates);
            @endphp

            <h2 class="mb-0">Ważna do {{$maxEndDate}}</h2>
        </div>
    </div>
        @endif
@endsection
