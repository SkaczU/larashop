@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
            <div class="card text-center mb-0">
                <div class="card-header">
                    <h1 class="card-title">Rejestracja</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end font-weight-bold"><b>Nazwa użytkownika</b></label>
                            <div class="col-md-8">
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Imię Nazwisko" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end font-weight-bold"><b>Adres email</b></label>
                            <div class="col-md-8">
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="przykladowy@mail.com" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="voivodeship" class="col-md-4 col-form-label text-md-end font-weight-bold"><b>Województwo</b></label>
                            <div class="col-md-8">
                                <select name="voivodeship" class="form-control" id="voivodeship" required>
                                    @foreach([
                                        'dolnoslaskie', 'kujawsko-pomorskie', 'lubelskie', 'lubuskie', 'lodzkie',
                                        'malopolskie', 'mazowieckie', 'opolskie', 'podkarpackie', 'podlaskie',
                                        'pomorskie', 'slaskie', 'swietokrzyskie', 'warminsko-mazurskie',
                                        'wielkopolskie', 'zachodniopomorskie'
                                    ] as $option)
                                        <option value="{{ $option }}" {{ old('voivodeship') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="shoe_size" class="col-md-4 col-form-label text-md-end"><b>Numer buta</b></label>
                            
                            <div class="col-md-4">
                                <input type="number" name="shoe_size" class="form-control" id="shoe_size" value="{{ old('shoe_size') }}" min="20" max="70">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-start"><b>Podaj Hasło</b></label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <button type="button" class="btn btn-link" id="togglePassword">Pokaż Hasło</button>
                            </div>
                            <div id="password-strength-text" class="text-muted mt-2"></div>
                        </div>

                        <div class="progress mt-2">
                            <div id="password-strength-bar" class="progress-bar password-strength-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password2" class="col-md-4 col-form-label text-md-start"><strong>Jeszcze raz</strong></label>
                            <div class="input-group">
                                <input type="password" name="password2" class="form-control" id="password2" required>
                                <button type="button" class="btn btn-link" id="togglePassword2">Pokaż Hasło</button>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button class="btn btn-primary btn-lg">Zarejestruj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function () {
        $('#password').on('input', function () {
            var password = $(this).val();

            if (!password) {
                $('#password-strength-bar').css('width', '0%').attr('aria-valuenow', 0);
                return;
            }
            
            var result = zxcvbn(password);

            var progressValue = (result.score + 1) * 25; // Convert score (0-4) kowertuje wartosc z raportu zcb na wartosc z paska (0-100)
            $('#password-strength-bar').css('width', progressValue + '%').attr('aria-valuenow', progressValue);

            var progressBarClass = 'bg-danger';
            if (result.score >= 3) {
                progressBarClass = 'bg-success';
            } else if (result.score === 2) {
                progressBarClass = 'bg-warning';
            }

            $('#password-strength-bar').removeClass().addClass('progress-bar ' + progressBarClass);

           // var feedbackText = 'Strength Score: ' + result.score + '<br>Feedback: ' + result.feedback.suggestions.join(', ');
            $('#password-strength-text').html(feedbackText);
        });

    $('#togglePassword').click(function () {
        togglePasswordVisibility('password');
    });

    $('#togglePassword2').click(function () {
        togglePasswordVisibility('password2');
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
});
</script>
@endsection