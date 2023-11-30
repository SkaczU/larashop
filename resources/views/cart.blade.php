@extends('layouts.app')

@section('content')
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h3>Koszyk</h3>    
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if ($cart->count() > 0)
                        <div class="card">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                    <tr>
                                        <th scope="col">Produkt</th>
                                        <th scope="col" width="120">Ilość</th>
                                        <th scope="col" width="120">Cena</th>
                                        <th scope="col" class="text-right" width="200"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>
                                                <figure class="media">
                                                    <figcaption class="media-body">
                                                        <h6 class="title text-truncate">{{ $item->name }}</h6>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $item->quantity }}" min="0" max="12" readonly>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var class="price">{{ $item->price }} zł</var>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <form action="{{ route('delete', ['id' => $item->id]) }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-outline-danger">Usuń</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">Brak produktów</div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    <dl class="dlist-align h4">
                        <dt>Suma:</dt>
                        <dd class="text-right"><strong>{{ $total }} zł</strong></dd>
                    </dl>
                    @if ($cart->count() > 0)
                        <hr>
                        <form action="{{ route('store') }}" method="post">
                            @csrf
                            Dara rozpoczęcia usług:  
                            <div class="col-sm-6 mb-6">
                            <form action="{{ route('store') }}" method="post">
                            <input type="date" class="form-control mb-3" id="startDate" name="startDate" min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}" required>
                            </form>
                            <div>
                            <button type="submit" class="btn btn-primary btn-block">Złóż zamówienie</button>
                        </form>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
