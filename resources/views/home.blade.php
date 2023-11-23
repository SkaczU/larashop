@extends('layouts.app')

@section('content')
<body>
    <div class="container">
       <h1> Welcome, {{ Auth::user()->name }}</h1>
    </div>
</body>
</html>
@endsection