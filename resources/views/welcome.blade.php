@extends('layouts.app')

@section('content')
<body>
    <div class="container">
    <h1>Nie bądź laczkiem <a class="btn btn-primary btn-lg" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a> aby dokonać zakupów usług</h1>

          <img src="https://img.joemonster.org/i/d/patmat.jpg" alt="Zdjecie ma opis bo tak jest poprawnie politycznie">
    </div>


</body>
</html>
@endsection