@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="col-sm-3 col-form-label">Rejestracja</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3 row align-items-center">
                            <label for="name" class="col-md-4 col-form-label text-md-start">Nazwa użytkownika</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Imię Nazwisko" required>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="email" class="col-md-4 col-form-label text-md-start">Adres email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="przykladowy@mail.com" required>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="password" class="col-md-4 col-form-label text-md-start">Podaj Hasło</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <div class="input-group-text">
                                    <input type="checkbox" id="showPassword">Pokaż Hasło
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-2">
                              <div id="password-strength-bar" class="progress-bar password-strength-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">Jeszcze raz</label>
                            <div class="input-group">
                                <input type="password" name="password-confirm" class="form-control" id="password-confirm" required>
                                <div class="input-group-text">
                                    <input type="checkbox" id="showPasswordConfirm">Pokaż Hasło
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="shoe_size" class="col-md-4 col-form-label text-md-end">Numer buta</label>
                            
                            <div class="col-md-4">
                                <input type="number" name="shoe_size" class="form-control" id="shoe_size" min="20" max="70">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Zarejestruj</button>
                            </div>
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

            var progressValue = (result.score + 1) * 25; // Convert score (0-4) to progress value (0-100)
            $('#password-strength-bar').css('width', progressValue + '%').attr('aria-valuenow', progressValue);

            var progressBarClass = 'bg-danger';
            if (result.score >= 3) {
                progressBarClass = 'bg-success';
            } else if (result.score === 2) {
                progressBarClass = 'bg-warning';
            }

            $('#password-strength-bar').removeClass().addClass('progress-bar ' + progressBarClass);

            var feedbackText = 'Strength Score: ' + result.score + '<br>Feedback: ' + result.feedback.suggestions.join(', ');
            $('#password-strength-text').html(feedbackText);
        });

        $('#showPassword').change(function () {
            var passwordInput = $('#password');
            if ($(this).prop('checked')) {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });

        $('#showPasswordConfirm').change(function () {
            var passwordConfirmInput = $('#password-confirm');
            if ($(this).prop('checked')) {
                passwordConfirmInput.attr('type', 'text');
            } else {
                passwordConfirmInput.attr('type', 'password');
            }
        });
    });
</script>
@endsection