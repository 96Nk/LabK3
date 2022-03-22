<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#7952b3">


    <style>
        body {
            background-image: url({{asset('assets/img/background-auth.jpg')}});
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

</head>
<body class="text-center">

<main class="form-signin">
    <form action="{{ route('login') }}" method="post" class="form-login">
        @csrf
        <div class="card">
            <div class="card-body">
                <h1 class="h3 mb-3 fw-normal">Form sign in</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username"
                           aria-label="Username">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i toggle="#password-content" class="bi bi-eye-slash toggle-password"></i>
                    </span>
                    <input type="password" class="form-control" name="password" id="password-content"
                           placeholder="password"
                           aria-label="Password">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger"><i class="bi bi-arrow-bar-left"></i>
                        Back to Home</a>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Sign in
                    </button>
                </div>
            </div>
            <div class="card-footer">
                <pre>
                    {{ json_encode(auth()) }}
                </pre>
                <p class="text-muted">&copy; 2022<br>Laboratorium K3<br>Pemerintah Provinsi Kalimantan Selatan</p>
            </div>
        </div>
    </form>
</main>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $('.toggle-password').click(function () {
        let input = $($(this).attr("toggle"));
        if (input.length > 0) {
            $(this).toggleClass("bi-eye bi-eye-slash");
            input.attr("type") === "password" ? input.attr("type", "text") : input.attr("type", "password");
        }
    })
    $('.form-login').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: (response) => {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        window.location.reload();
                    })
                } else {
                    Swal.fire('Failed', response.message, 'error')
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                Swal.fire('The Internet?', 'That thing is still around?', 'error');
            }
        })
        return false;
    });
</script>
</body>
</html>
