@extends('layouts.app')

@section('content')
    <div class="container">
        @if($orderItems->isEmpty())
        <p>Brak Dostępu do usługi</p>
         @else
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">{{$service->name}}</h1>
        </div>
            <div class="row justify-content-center">
                <p>Skoro tu dotarłeś musisz umrzeć</p>
            <img src="https://i.ytimg.com/vi/tXi_Bqb3q94/hqdefault.jpg" alt="Description of the image">
            </div>

        @endif



    </div>
@endsection