<title>Đăng nhập</title>
<style>
    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    @media (min-width: 1025px) {
        .h-custom-2 {
            height: 100%;
        }
    }

    .h-custom-2 {
    height: 85%;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://utt.edu.vn/publics/template/default/img/favicon.ico">

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 text-black">
                <div class="px-5 ms-xl-4">
                    <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                    <span class="h1 fw-bold mb-0"><a href="{{ route('home') }}"><img style="height: 62px; width: 96px; margin: 60px 0 -66px 120px;" src="https://ci3.googleusercontent.com/proxy/7RJrDORxCsPOwYwEAW-1g0WsEP-w0Zh4xMI8wJdjSnH1sBPUrEHya8Oon5_FADaB8dZONQa1qRrI9cLcvGohymHJlpyXKNyiz_16WQ=s0-d-e1-ft#http://utt.edu.vn/home/images/stories/logo-utt-border.png" alt="Logo UTT"></a></span>
                </div>
                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form action="{{ route('postLogin') }}" method="POST" style="width: 23rem;">
                        @csrf
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                        <div class="form-outline mb-4">
                            <input type="email" id="form2Example18" name="email" class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example18">Email address</label>
                            @error('email')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example28" name="password"
                                class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example28">Password</label>
                            @error('password')
                                <small class="help-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="pt-1 mb-4">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                        </div>

                        <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>

                    </form>
                </div>
            </div>
            <div class="col-sm-8 px-0 d-none d-sm-block">
                <img src="{{ asset('public/uploads') }}/totnghiep.jpg" alt="Login image" class="w-100 vh-100"
                    style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>

