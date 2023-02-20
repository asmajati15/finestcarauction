@extends('auction/layout')

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
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">Dashboard</h1>
                    </div>
                    <!-- Actions -->
                    {{-- <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                <span class=" pe-2">
                                    <i class="bi bi-pencil"></i>
                                </span>
                                <span>Edit</span>
                            </a>
                            <button type="button" class="btn d-inline-flex btn-sm blue-800 mx-1" data-bs-toggle="modal" data-bs-target="#AddModal">
                                <span class=" pe-2">
                                    <i class="bi bi-plus"></i>
                                </span>
                                <span>Create</span>
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <!-- Card stats -->
            <div class="row g-6 mb-6 row-cols-3">
                @foreach ($lots as $lot)
                <div class="col-xl-3 col-sm-3 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="">
                                    <img class="rounded-2" src="/lot-images/{{ $lot->image }}" alt="">
                                </div>
                                <div class="mt-5">
                                    <span class="h4 classic fw-semibold d-block mb-2 lot-name lots-name">{{$lot->name}}</span>
                                    <span class="h6 text-muted fw-light d-block mb-2">Starts from: Rp{{number_format($lot->start_price)}}</span>
                                    <span class="h5 fw-normal f-block mb-0">Current bid: Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}</span>
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
                                    <button type="button" class="btn btn-outline-secondary text-center w-100" disabled>
                                        <p class="text-center">Bid Ends</p>
                                    </button>
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