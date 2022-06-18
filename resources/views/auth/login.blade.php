<x-auth.app-layout title="Form Login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <img class="bg-img-cover bg-center" src="{{ asset('assets/images/background-auth.jpg') }}"></div>
            {{--                <img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/3.jpg') }}"></div>--}}
            <div class="col-xl-6 p-0">
                <div class="login-card radius-left">
                    <form action="{{route('login')}}" method="post" class="theme-form login-form">
                        @csrf
                        @if(session('message'))
                            <x-alert-session type="{{session('type')}}" status="{{session('status')}}"
                                             title="{{session('message')}}"/>
                        @endif
                        <h4>Login</h4>
                        <h6>Welcome back! Log in to your account.</h6>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input class="form-control" autofocus type="text" name="username"
                                       placeholder="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                <i toggle="#password-content" class="bi bi-eye-slash toggle-password"></i>
                                </span>
                                <input class="form-control" id="password-content" type="password" name="password"
                                       required=""
                                       placeholder="*********">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a class="link" href="#">Forgot password?</a>
                            <button class="btn btn-primary btn-block" type="submit">
                                <i class="bi bi-box-arrow-in-right"></i> Sign in
                            </button>
                        </div>
                        <div class="login-social-title">
                            <h5>Sign Up Company</h5>
                        </div>
                        <p>Don't have account?<a class="ms-2" href="{{ route('registration') }}">Create Account</a></p>
                        <br>
                        <a class="btn btn-outline-danger btn-block" href="{{ route('home') }}">
                            <i class="bi bi-arrow-bar-left"></i> Back to Home
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('js.global')
    @slot('script')
        <script>
            $('.toggle-password').click(function () {
                let input = $($(this).attr("toggle"));
                if (input.length > 0) {
                    $(this).toggleClass("bi-eye bi-eye-slash");
                    input.attr("type") === "password" ? input.attr("type", "text") : input.attr("type", "password");
                }
            });
            $('.login-form').submit(function (event) {
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
    @endslot
</x-auth.app-layout>
