<!DOCTYPE html>
<html lang="en">
<    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('/css/style.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="layer"></div>
    <main class="page-center bg-light">
        <article class="sign-up">
            <img src="{{asset('/image/logo.png')}}" style="width: 500px; height: 100px;" alt="">
            <p class="mx-auto">Obtain everything you want with the price you want!</p>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="sign-up-form form" action="" method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <label class="form-label-wrapper" for="email" :value="__('Email')">
                    <p class="form-label">Email</p>
                    <input class="form-input" id="email" class="block mt-1 w-full" type="email"
                        placeholder="Enter your email" name="email" :value="old('email')" required autofocus
                        autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </label>
                <!-- Password -->
                <div class="mt-4">
                    <label class="form-label-wrapper" for="password" :value="__('Password')">
                        <p class="form-label">Password</p>
                        <input class="form-input" id="password" class="block mt-1 w-full" type="password"
                            placeholder="Enter your password" name="password" required
                            autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </label>
                </div>

                <label class="mx-auto form-checkbox-wrapper">
                    <span class="form-checkbox-label text-center"> <a class=""
                            href="{{ route('register') }}">Dont have an account?</a></span>
                </label>

                <button class="form-btn primary-default-btn transparent-btn">Sign in</button>
            </form>
        </article>
    </main>
    <!-- Chart library -->
    <script src="./plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
</body>
</html>
