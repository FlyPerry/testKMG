<html lang="ru" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <title>Signup</title>

    <link href="css/site.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid d-flex h-100vh">
    <main class="main content p-0 w-100">
        <div class="auth-bg create-account-container"></div>
        <div class="auth position-relative row">
            <div class="col-12 col-sm-6 col-lg-7 d-flex flex-column justify-content-between">
                <div>
                    <div id="changeLang" class="dropdown btn-group">
                        <button id="changeLang-button" class="btn dropdown-toggle btn-xsm changeLangButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Русский
                        </button>

                        <div id="w0" class="dropdown-menu"><a class="dropdown-item" href="">English
                                (AF)</a>
                            <a class="dropdown-item" href="">English (UK)</a>
                            <a class="dropdown-item" href="">Русский</a></div>
                    </div>
                </div>
                <h1 class="auth-title white text-center text-sm-start mt-4 mb-4">Добро пожаловать на образовательную
                    платформу SWC!</h1>
                <p class="footer-year d-none d-sm-block">© 2023 WWDA ETC.</p>
            </div>
            <div class="col-12 col-sm-6 col-lg-5 d-flex align-items-center">
                <div class="card fs-p-14 w-100">
                    <div class="card-body">
                        <img class="auth_logo" src="assets/logo_purple.svg" alt="SWC Logo">
                        <h2 class="auth__title mt-4 mb-3 pt-3">Создать учетную запись</h2>
                        <div class="mb-4 pb-2">
                            <form id="register-form">
                                <div class="input input_white input_large mb-3">
                                    <div class="form-group field-signupform-firstname required">

                                        <input type="text" id="signupform-firstname" class="is-invalid"
                                               name="first_name" autofocus="" placeholder="Имя" required>

                                    </div>
                                </div>
                                <div class="input input_white input_large mb-3">
                                    <div class="form-group field-signupform-lastname required">

                                        <input type="text" id="signupform-lastname" class="is-invalid"
                                               name="last_name" autofocus="" placeholder="Фамилия" required>

                                    </div>
                                </div>
                                <div class="input input_white input_large mb-3">
                                    <div class="form-group field-signupform-email required">

                                        <input type="email" id="signupform-email" class="" name="email"
                                               placeholder="Email" required>

                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="input input-password input_white input_large mb-3">
                                    <div class="form-group field-signupform-password required">

                                        <input type="password" id="signupform-password" class=""
                                               name="password" placeholder="Пароль" required>

                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="input input-password input_white input_large mb-3">
                                    <div class="form-group field-signupform-password required">

                                        <input type="password" id="signupform-password-confirm" class=""
                                               name="confirm_password" placeholder="Подтверждение пароля" required>

                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-lg minw-auto w-100"
                                        id="register-button">Продолжить
                                </button>
                            </form>
                            <div id="registration-message" style="display: none;"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="script.js"></script>
</body>
</html>
