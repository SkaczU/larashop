@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">{{ $service->name }}</h1>
        </div>

        @if ($orderItems->isEmpty())
            <p>Brak dostępu do usługi</p>
        @else
            <div class="row justify-content-center">
                {{-- <h2 class="mb-0">Ważna do {{$maxEndDate}}</h2> --}}
                <div class="embed-responsive embed-responsive-16by9 box" style="width: 80%;">
                    <div id="leaflet-map" class="embed-responsive-item" style="height: 500px; width: 100%;"></div>
                </div>

                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                
                <script>
                    function initMap() {
                        var map = L.map('leaflet-map').setView([51.9194, 19.1451], 6);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Iteruj po stacjach meteorologicznych i dodaj markery na mapie
                        @foreach ($data['content'] as $station)
                            var marker = L.marker([{{ $station['latitude'] }}, {{ $station['longitude'] }}]).addTo(map);
                            marker.bindPopup('<b>{{ $station['name'] }}</b><br>{{ $station['tercCode'] }}');
                        @endforeach
                    }
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        initMap();
                    });
                </script>
            </div>
        @endif
    </div>
@endsection