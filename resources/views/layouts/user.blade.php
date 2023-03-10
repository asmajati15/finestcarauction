<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <style>
        /* Webpixels CSS */
        /* Utility and component-centric Design System based on Bootstrap for fast, responsive UI development */
        /* URL: https://github.com/webpixels/css */

        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

        /* Bootstrap Icons */
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");

        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .classic {
            font-family: 'Playfair Display', serif;
        }

        .blue-800 {
            background-color: #23448d;
            color: #fff;
        }

        .blue-800:hover {
            background-color: #182d5c;
            color: #fff;
        }

        .blue-800-outline {
            background-color: #ffffff;
            color: #23448d;
            border-color: #23448d;
        }

        .blue-800-outline:hover {
            background-color: #182d5c;
            color: #fff;
        }

        .blue-600 {
            background-color: #3468d6;
            color: #fff;
        }

        .blue-600:hover {
            background-color: #23448d;
            color: #fff;
        }

        .carousel img {
            height: 500px;
            object-fit: cover;
            background-repeat: no-repeat;
        }

        .lot-name {
            display: block;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .lots-name {
            text-transform: uppercase;
        }

        @media(min-width: 1024px) {
            .large-screen {
                width: 80%;
            }
        }

        @media(max-width: 1024px) {
            .user-setting {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Dashboard -->
        <!-- Vertical Navbar -->
        {{-- <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="{{route('lot.index')}}">
                    <img src="{{asset('image/logo.png')}}" alt="...">
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->type != 'user')
                                <li class="nav-item">
                                    <a class="nav-link" 
                                    @if (auth()->user()->type == 'manager')
                                        href="{{route('manager.index')}}"
                                    @else
                                        href="{{route('admin.index')}}"
                                    @endif
                                    >
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>
                                </li>
                                @endif
                            @endauth
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('lot.index')}}">
                                <i class="bi bi-hammer"></i> Auction
                            </a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->type == 'manager')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('manager.lot.sell')}}">
                                            <i class="bi bi-wallet"></i> Sell Lots
                                        </a>
                                    </li>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('manager.category.index')}}">
                                            <i class="bi bi-tags"></i> Category
                                        </a>
                                    </li>
                                @elseif (auth()->user()->type == 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('admin.userList')}}">
                                            <i class="bi bi-people-fill"></i> User List
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('bid.history')}}">
                                            <i class="bi bi-clock-history"></i> History
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                    <!-- Push content down -->
                    <div class="mt-auto"></div>
                    <!-- User (md) -->
                    @if (Route::has('login'))
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-square"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link" style="background-color: #fff">
                                    <i class="bi bi-box-arrow-left" style="margin-left: -10px;"></i> <span style="margin-left: 10px">Logout</span>
                                </button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item" style="margin-left: 20px;">
                            <a class="btn blue-800" href="{{ route('login') }}">
                                Login
                            </a>
                            <a class="btn blue-800-outline" style="margin-left: 10px;" href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                        @endauth
                    </ul>

                    @endif
                </div>
            </div>
        </nav> --}}
        <nav class="navbar fixed-top navbar-expand-lg bg-white" style="box-shadow: ">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <a class="navbar-brand" href="{{ route('lot.index') }}"><img src="{{ asset('image/logo.png') }}" alt=""></a>
                </ul>
                <ul class="navbar-nav mx-auto mt-1">
                    <form action="{{ route('lot.index') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <button class="btn blue-800" type="submit" title="Search">
                                <span class="bi bi-search"></span>
                            </button>
                            <input type="text" class="form-control mr-2" name="q" placeholder="Search lot items" id="q">
                            <a href="{{ route('lot.index') }}" class="btn blue-600" title="Refresh Page">
                                <span class="bi bi-arrow-clockwise"></span>
                            </a>
                        </div>
                    </form>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bid.history') }}">History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-square"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-square"></i><span style="margin-left:10px;">Edit Profile</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-left"></i><span style="margin-left:10px;">Logout</span>
                                    </button>
                                </form>    
                            </li>
                        </ul>
                    </li>          
                    @else
                    <li class="nav-item" style="margin-right: 5px;">
                        <a class="mt-1 btn blue-800" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="mt-1 btn blue-800-outline" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                    @endauth
                    @endif
                </ul>
              </div>
        </nav>
        <!-- Main content -->
        @yield('main-content')

        
        <footer class="align-item-center py-4">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md my-5">
                        <h3 class="classic mb-5">COMPANY</h3>
                        <p class="my-2">About</p>
                        <p class="my-2">Carreers</p>
                        <p class="my-2">Contact</p>
                        <p class="my-2">Terms</p>
                        <p class="my-2">Privacy & Policy</p>
                    </div>
                    <div class="col-md my-5">
                        <img src="{{ asset('image/logo.png') }}" alt="" style="width:275px; height:50px; margin-left:-10px; margin-top: -10px;">
                        <p style="font-size: 24px">
                            <a href="https://www.instagram.com"><i class="bi bi-instagram" style="margin-right: 10px"></i></a>
                            <a href="https://www.facebook.com"><i class="bi bi-facebook" style="margin-right: 10px"></i></a>
                            <a href="https://www.twitter.com"><i class="bi bi-twitter" style="margin-right: 10px"></i></a>
                            <a href="https://www.youtube.com"><i class="bi bi-youtube" style="margin-right: 10px"></i></a>
                        </p>
                        <p class="my-2">??2023 Finestauction???. All Rights Reserved</p>
                    </div>
                    <div class="col-md my-5">
                        <h3 class="classic mb-5">HELP CENTER</h3>
                        <form action="{{ route('message') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="youremail@example.com">
                            <textarea class="mt-1 form-control @error('message') is-invalid @enderror" name="message" id="" cols="1" rows="2" placeholder="Write your message here..."></textarea>
                            <button type="submit" class="mt-1 btn blue-800 float-end">Send</button>
                        </form>
                        <small class="text-muted"><i>*admin will reply your message with email</i></small>
                    </div>
                </div>
            </div>
            <p class="text-center"></p>
        </footer>
    <!-- <script src="{{ mix('/js/app.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    @yield('js')
</body>

</html>
