<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <link rel="icon" href="../../dist/img/logosekolah.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/css/login.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

        <style>

            .posisi {
                        position: absolute;
                        top: 95px;
                        left: 0;
                        right: 0;
                        text-align: center;
             
                    }
            </style>
            
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../../dist/img/logosekolah.png" alt="logo sekolah"
                            class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="posisi">            
                    @if ($errors->any())
                        <div class="alert alert-danger  p-0">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li> {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
               
                <div class="d-flex justify-content-center form_container">
       
                    <form action="" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="email" class="form-label"></label>
                            <input type="email" value="{{ old('email') }}" name="email"
                                class="form-control input_user" placeholder="email">

                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="password" class="form-label"></label>
                            <input type="password" name="password" class="form-control input_pass" placeholder="password">

                        </div>

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="submit" class="btn login_btn">Login Aplikasi Bimbingan Konseling</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</body>

</html>
