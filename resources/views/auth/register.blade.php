<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            <!-- Form -->
            <form class="sign-up-form form" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="mt-4">
                    <label class="form-label-wrapper" for="name" :value="__('Name')">
                        <p class="form-label">Name</p>
                        <input id="name" class="form-input" class="block mt-1 w-full" type="text" placeholder="Enter your name"
                            name="name" :value="old('name')" required autofocus autocomplete="name">
                    </label>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <label class="form-label-wrapper" for="email" :value="__('Email')">
                        <p class="form-label">Email</p>
                        <input id="email" class="form-input" class="block mt-1 w-full" type="email" placeholder="Enter your email"
                            name="email" :value="old('email')" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </label>
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <label class="form-label-wrapper" for="password" :value="__('Password')">
                        <p class="form-label">Password</p>
                        <input class="form-input" id="password" class="block mt-1 w-full"D type="password"
                            placeholder="Enter your password" name="password" required autocomplete="new-password"
                            required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </label>
                </div>
                <!-- Confirm Password -->
                <div class="mt-2">
                    <label class="form-label-wrapper" for="password_confirmation" :value="__('Confirm Password')">
                        <p class="form-label">Confirm Password</p>
                        <input class="form-input" placeholer id="password_confirmation" class="block mt-1 w-full"
                            type="password" placeholder="Confirm your password" name="password_confirmation" required
                            autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </label>
                </div>

                <label class="mx-auto form-checkbox-wrapper">
                    <span class="form-checkbox-label"> <a class="text-center" href="{{ route('login') }}">Already have
                            an account?</a></span>
                </label>

                <button class="form-btn primary-default-btn transparent-btn"> {{ __('Sign Up') }}</button>
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
