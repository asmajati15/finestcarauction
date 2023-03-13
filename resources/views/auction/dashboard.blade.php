@extends('layouts/home')

@section('title')
Finestcarauction
@endsection

@section('main-content')
<div class="h-screen flex-grow-1 overflow-y-lg-auto large-screen" style="">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom py-6">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <!-- Actions -->
                    <div class="col-sm-10 col-12 mx-auto">
                        <div class="mx-n1">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ asset('image/slide1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="text-white">Authentic Items</h3>
                        <p>Items auctioned are guaranteed 100% authentic.</p>
                    </div>                
                  </div>
                  <div class="carousel-item" data-bs-interval="5000">
                    <img src="{{ asset('image/slide2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="text-white">Easy to Bid</h3>
                        <p>Grab your chance to own the authentic items.</p>
                    </div> 
                  </div>
                  <div class="carousel-item" data-bs-interval="5000">
                    <img src="{{ asset('image/slide3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <a href="{{ url('register') }}" class="btn blue-800 mx-1">Register Now!</a>
                        <p>Before submit your best bid.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h2 class="mb-3 ls-tight pt-6 pb-2 text-center">All Auctions</h2>
            <!-- Card stats -->
            <div class="row g-6 mb-6 row-cols-3">
                @foreach ($lots as $lot)
                <div class="col-xl-3 col-sm-3 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="" sty>
                                    <img class="rounded-2" src="/lot-images/{{ $lot->image }}" alt="">
                                </div>
                                <div class="mt-5">
                                    <span class="h4 classic fw-semibold d-block mb-2 lot-name lots-name">{{$lot->name}}</span>
                                    <span class="h6 text-muted fw-light d-block mb-2">Starts from: Rp{{number_format($lot->start_price)}}</span>
                                    <span class="h5 fw-normal f-block mb-0">Current bid: Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}</span>
                                    {{-- <span class="h5 fw-normal f-block mb-0">Current bid: Rp{{number_format($lot->final_price) }}</span> --}}
                                </div>
                            </div>
                            <div class="mt-2 mb-0 text-sm">
                                <span class="badge badge-pill bg-soft-secondary text-danger me-2">
                                    <i class="bi bi-clock-history me-1"></i>
                                    <span class="clockdiv" data-date="{{$lot->end_time}}">
                                        <span class="days"></span>
                                        <span class="days1"></span>
                                        <span class="hours"></span>
                                        <span class="hours1"></span>
                                        <span class="minutes"></span>
                                        <span class="minutes1"></span>
                                        <span class="seconds"></span>
                                        <span class="seconds1"></span>
                                    </span>
                                </span>
                                {{-- <span class="text-nowrap text-xs text-muted">{{$lot->user->name}}</span> --}}
                            </div>
                            <div class="mt-2 mb-0 text-sm">
                                @if ($lot->end_time <= $current_time)
                                    {{-- @if (DB::table('bids')->select('user_id')->where('lot_id',$lot->id)->orderBy('bid_price', 'DESC')->first()->user_id==Auth::id()) --}}
                                    @if (Auth::user()!=null)
                                        @if ($lot->user_id==Auth::id())
                                            <a href="{{ url('lot',$lot->id)}}" class="btn btn-outline-success text-center w-100">
                                                <p class="text-center">Go to Payment</p>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-secondary text-center w-100" disabled>
                                                <p class="text-center">Bid Ends</p>
                                            </button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-outline-secondary text-center w-100" disabled>
                                            <p class="text-center">Bid Ends</p>
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ url('lot',$lot->id)}}" class="btn text-center w-100 blue-800">
                                        <p class="text-center">Bid</p>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>  
        </div>
    </main>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
    document.addEventListener('readystatechange', event => {
        if (event.target.readyState === "complete") {
            var clockdiv = document.getElementsByClassName("clockdiv");
            var countDownDate = new Array();
            for (var i = 0; i < clockdiv.length; i++) {
                countDownDate[i] = new Array();
                countDownDate[i]['el'] = clockdiv[i];
                countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
                countDownDate[i]['days'] = 0;
                countDownDate[i]['hours'] = 0;
                countDownDate[i]['seconds'] = 0;
                countDownDate[i]['minutes'] = 0;
            }

            var countdownfunction = setInterval(function() {
                for (var i = 0; i < countDownDate.length; i++) {
                    var now = new Date().getTime();
                    var distance = countDownDate[i]['time'] - now;
                    countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                    countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 *
                        60 * 60));
                    countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 *
                        60));
                    countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);

                    if (distance < 0) {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = "Expired";
                    } else {
                        countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i][
                            'days'
                        ];
                        countDownDate[i]['el'].querySelector('.days1').innerHTML = "d";
                        countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i][
                            'hours'
                        ];
                        countDownDate[i]['el'].querySelector('.hours1').innerHTML = "h";
                        countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i][
                            'minutes'
                        ];
                        countDownDate[i]['el'].querySelector('.minutes1').innerHTML = "m";
                        countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i][
                            'seconds'
                        ];
                        countDownDate[i]['el'].querySelector('.seconds1').innerHTML = "s";
                    }

                }
            }, 1000);
        }
    });
</script>
@endsection