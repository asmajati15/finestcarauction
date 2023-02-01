@extends('auction/layout')

@section('title')
Detail
@endsection

@section('main-content')
<div class="h-screen flex-grow-1 overflow-y-lg-auto large-screen" style="">
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <!-- Card stats -->
            <div class="row mb-6 row-cols-2">
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="item-images">
                        <img src="/lot-images/{{$lots->image}}" alt="">
                    </div>
                    <h2 class="classic fw-semibold d-block my-5">Description<h2>
                    <h4 class="fw-semi-bold d-block mb-2">{{$lots->name}}</h4>
                    <h5 class="text-muted fw-light d-block mb-2">{{$lots->description}}</h5>
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="m-2">
                                <div class="row">
                                    <span class="h1 classic fw-semibold d-block mb-5">{{$lots->name}}</span>
                                    <div class="col">
                                        <span class="h4 text-muted fw-light d-block mb-2">Estimate:</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="h4 text-muted fw-light d-block mb-2">Rp{{number_format($lots->min_price)}} - Rp{{number_format($lots->max_price)}}</span>
                                    </div>
                                    <hr>
                                    <div class="col">
                                        <span class="h3 fw-normal f-block">Current bid:</span>
                                        <span class="h6 text-muted fw-light d-block mt-1 mb-5">(0 bids)</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="h3 fw-normal f-block mb-0">Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lots->id)->orderBy('bid_price')->first()) ? $ac->bid_price : 0,0,',','.') }}</span>
                                    </div>
                                    <hr style="clear:both; visibility:hidden; padding: 0px; margin: 0px;">
                                    <div class="col">
                                        <span class="h4 text-muted fw-light d-block">Lot closes:</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="h4 text-muted fw-light d-block"><span class="clockdiv" data-date="{{$lots->end_time}}">
                                            <span class="days"></span>
                                            <span class="days1"></span>
                                            <span class="hours"></span>
                                            <span class="hours1"></span>
                                            <span class="minutes"></span>
                                            <span class="minutes1"></span>
                                            <span class="seconds"></span>
                                            <span class="seconds1"></span>
                                        </span>
                                        <span class="h4 text-muted fw-light d-block mt-1">{{date('d M Y, h:m A e', strtotime($lots->end_time));}}</span>
                                    </div>
                                    <a href="lot/{{$lots->id}}" class="btn text-center w-100 blue-800 mt-5">
                                        <p class="text-center">Bid</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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