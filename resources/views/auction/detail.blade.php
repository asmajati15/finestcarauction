@extends('auction/layout')

@section('title')
Finestcarauction - {{$lots->name}}
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
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="m-2">
                                <div class="row">
                                    <span class="h1 classic fw-semibold d-block mb-5 lots-name">{{$lots->name}}</span>
                                    <div class="col">
                                        <span class="h4 text-muted fw-light d-block mb-2">Estimate:</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="h4 text-muted fw-light d-block mb-2">Rp{{number_format($lots->min_price)}} - Rp{{number_format($lots->max_price)}}</span>
                                    </div>
                                    <hr>
                                    <div class="col">
                                        <span class="h3 fw-normal f-block">Current bid:</span>
                                        <span class="h6 text-muted fw-light d-block mt-1 mb-5">({{$lots->bid->count()}} bids)</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="h3 fw-normal f-block mb-0">Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lots->id)->orderBy('bid_price','DESC') ->first()) ? $ac->bid_price : 0,0,',','.') }}</span>
                                        <span class="h6 text-muted fw-light d-block mt-1 mb-5">
                                            @if($lots->id_user === 0)
                                            Not yet bid
                                            @else
                                            {{$lots->user->name}}
                                            @endif
                                        </span>
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

                                    {{-- @dd($lots->end_time,$current_time,Date(strtotime($current_time)) < Date(strtotime($lots->end_time))) --}}
                                    @if ($lots->end_time <= $current_time)
                                        <button type="button" class="btn btn-outline-secondary text-center w-100 mt-5" disabled>
                                            <p class="text-center">Bid Ends</p>
                                        </button>
                                    @else
                                        <button type="button" class="btn text-center w-100 blue-800 mt-5" data-bs-toggle="modal" data-bs-target="#BidModal">
                                            <p class="text-center">Bid</p>
                                        </button>
                                    @endif
                                    {{-- @if ($user_tertinggi = DB::table('bids')->orderBy('bid_price', 'desc')->first())
                                        <button type="button" class="btn text-center w-100 blue-800 mt-5" data-bs-toggle="modal" data-bs-target="#BidModal">
                                            <p class="text-center">Buy</p>
                                        </button>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="classic fw-semibold d-block my-5">Description<h2>
                    <h4 class="fw-semi-bold d-block mb-2">{{$lots->name}}</h4>
                        {{-- <div class="outer" id="portfolio"> --}}
                            <h5 class="text-muted fw-light d-block mb-2">{{$lots->description}}</h5>
                        {{-- </div> --}}
                    {{-- <div style="padding-top: 30px;">
                        <a class="button" style="color: #23448d">
                          <strong id="expandbtn">
                            Read More
                          </strong>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
</div>
<form action="{{ route('bid.new',$lots->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="BidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Bid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">New Bid</label>
                        {{-- @if ($lots->bid->) --}}
                        {{-- <input type="text" class="form-control" name="bid_price" min="{{$lots->bid->bid_price + 1}}"> --}}
                        {{-- @else --}}
                            
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn blue-800" name="save" value="Submit">
                </div>
            </div>
        </div>
    </div>
</form>
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

    $(document).ready(function () {
    $("#expandbtn").click(function () {
        if ($("#portfolio").hasClass("readmore")) {
        $("#expandbtn").html("Read More");
        $("#portfolio").removeClass("readmore");
        } else {
        $("#expandbtn").html("Read Less");
        $("#portfolio").addClass("readmore");
        }
    });
    });
</script>
@endsection