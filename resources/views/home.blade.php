@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
                Pokaż / Ukryj Filtry
            </button>
        </div>
    </div>
    
    <div class="row collapse show" id="collapseFilters">
        <div class="col-md-4 d-flex flex-fill">
            <div class="card mb-3 d-flex flex-fill">
                <div class="card-body">
                    <form class="form-inline mt-4" method="GET" action="{{ route('services') }}">
                        <div class="d-flex align-items-center">
                            <input class="form-control mr-3" placeholder="Szukaj" name="title" type="text" value="{{ Request::input('title')}}">
                        </div>
                        <div class="card mt-4">
                            <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"> Szukaj</i></button>
                        </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-4 d-flex flex-fill">
            <div class="card mb-3 d-flex flex-fill">
                <div class="card-body">
                    <h6 class="title">Usługi</h6>
                    <div style="" class="filter-content collapse show">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="available" id="available1" value="1" {{ Request::input('available') == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="available1">
                                    Dostępne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="available" id="available0" value="0" {{ Request::input('available') == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="available0">
                                    Niedostępne
                                </label>
                            </div>     
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="available" id="available3" value="" {{ Request::input('available') == '' ? 'checked' : '' }}>
                                <label class="form-check-label" for="available3">
                                    Wszystkie
                                </label>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex flex-fill">
            <div class="card mb-3 d-flex flex-fill">
                <div class="card-body">
                    <h6 class="title mt-3">Cena</h6>
                        <div class="form-group">
                            <label for="min">Od</label>
                            <input name="min" id="min" class="form-control mx-2" placeholder="0 zł" min="0" max="10000" type="number" value="{{ Request::input('min')}}">
                        </div>
                        <div class="form-group">
                            <label for="max">Do</label>
                            <input name="max" id="max" class="form-control mx-2" placeholder="10000 zł" min="0" max="10000" type="number"  value="{{ Request::input('max')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
        <br>
        
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nazwa usługi</th>
                    <th>Opis</th>
                    <th>Cena (zł)</th>
                    <th>Ilość</th>
                    <th>Zamów</th>
                </tr>
            </thead>
            <tbody>
                @if($service->count() > 0)
                    @foreach($service as $rs)
                        <tr>
                            <form method="POST" action="{{ route('addToCart', ['id' => $rs->id]) }}">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->name }}</td>
                            <td class="align-middle" style="width: 50%">{{ $rs->description }}</td> 
                            <td class="align-middle">{{ $rs->price }} zł</td>
                            @if($rs->available == 1)
                            <td class="align-middle"><input type="number" name="quantity" class="form-control" id="quantity" min="1" max="12" value="1"></td>
                            <td class="align-middle">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-shopping-cart"></i> Do Koszyka
                                        </button>
                                    </div>
                                </form>
                            </td>
                            @else
                            <td class="align-middle"></td>
                            <td class="align-middle">
                            Usługa narazie niedostępna
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var collapseFilters = new bootstrap.Collapse(document.getElementById('collapseFilters'), {
                toggle: false
            });
        });
    </script>
@endsection