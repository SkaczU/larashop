@extends('layouts.app')

@section('content')
<body>
    <div class="container">
    <h1>Nie bądź laczkiem <a class="btn btn-primary btn-lg" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a> aby dokonać zakupów usług</h1>

    <div style="overflow: hidden;">
        <img src="https://img.joemonster.org/i/d/patmat.jpg" alt="Zdjecie ma opis bo tak jest poprawnie politycznie" style="float: left; margin-right: 10px;">
        <div class="mt-5">
        <h2>Albo <a class="btn btn-success btn-lg" href="{{ route('register') }}">{{ __('Zarejestruj się') }}</a> i kontynuuj przegladanie strony :)</h2>
        </div>
    </div>
    
    </div>

</body>
</html>
@endsection