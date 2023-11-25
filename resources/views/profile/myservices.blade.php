@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Dostępne Usługi</h1>
                </div>
                <hr />
                <div class="card-body">
                    @if($services->isEmpty())
                        <p>Brak Zakupionych usług.</p>
                    @else
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID usługi</th>
                                    <th>Nazwa Usługi</th>
                                    <th>Usługa Aktywna od</th>
                                    <th>Usługa Aktywna do</th>
                                    <th>Przejdz do</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td class="align-middle">{{ $service->service_id }}</td>
                                        <td class="align-middle">{{ $service->service->name }}</td>
                                        <td class="align-middle">{{ $service->start_date }}</td>
                                        <td class="align-middle">{{ $service->end_date }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/services/{{$service->service_id}}" type="button" class="btn btn-secondary">Podgląd</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
