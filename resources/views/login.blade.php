@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="card-title">Logowanie</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 row align-items-center">
                            <label for="email" class="col-md-4 col-form-label text-md-start"><b>Adres email</b></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="przykladowy@mail.com" required>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="password" class="col-md-4 col-form-label text-md-start"><b>Podaj Hasło</b></label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <button type="button" class="btn btn-link" id="togglePassword">Pokaż Hasło</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Logowanie</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
        $('#togglePassword').click(function () {
        togglePasswordVisibility('password');
    });

    $('#togglePasswordConfirm').click(function () {
        togglePasswordVisibility('password_confirmation');
    });

    function togglePasswordVisibility(inputId) {
        var passwordInput = $('#' + inputId);
        var passwordButton = $('#toggle' + inputId.capitalize());

        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            passwordButton.text('Ukryj Hasło');
        } else {
            passwordInput.attr('type', 'password');
            passwordButton.text('Pokaż Hasło');
        }
    }

    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };
</script>
@endsection