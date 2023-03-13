@extends('layouts/home')

@section('title')
Finestcarauction - History
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
                        <h1 class="h2 mb-0 ls-tight">Bid History</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Successful Bids & Bids In Progress</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Bid End</th>
                                <th scope="col">Bid Winner</th>
                                <th scope="col">Highest Bid</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bid->lots as $bid->lot)

                            <tr>
                                <td>
                                    <img alt="{{$bid->lot->name}}" src="/lot-images/{{ $bid->lot->image }}" class="avatar avatar-sm rounded-circle me-2">
                                    <a class="text-heading font-semibold" href="{{ url('lot',$bid->lot->id)}}"> {{$bid->lot->name}} </a>
                                </td>
                                <td>
                                    {{date('d M Y, h:m A e', strtotime($bid->lot->end_time));}}
                                </td>
                                <td>
                                    {{$bid->lot->user->name}}
                                </td>
                                <td>
                                    Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$bid->lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                </div>
            </div>
            {{-- <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Loses Bid</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Bid End</th>
                                <th scope="col">Bid Winner</th>
                                <th scope="col">Highest Bid</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bid->lots2 as $bid->lot)
                                @if ($bid->lot->user_id != NULL)
                                    <tr>
                                        <td>
                                            <img alt="{{$bid->lot->name}}" src="/lot-images/{{ $bid->lot->image }}" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="{{ route('lot.show',$bid->lot->id) }}"> {{$bid->lot->name}} </a>
                                        </td>
                                        <td>
                                            {{date('d M Y, h:m A e', strtotime($bid->lot->end_time));}}
                                        </td>
                                        <td>
                                            {{$bid->lot->user->name}}
                                        </td>
                                        <td>
                                            Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$bid->lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}
                                        </td>
                                        <td>
                                            @if ($bid->lot->end_time <= $current_time)
                                                @if (DB::table('bids')->select('user_id')->where('lot_id',$bid->lot->id)->orderBy('bid_price', 'DESC')->first()->user_id==Auth::id())
                                                    <span class="badge badge-pill bg-soft-success text-success me-2">
                                                        <span>Win</span>
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                                        <span>Lose</span>
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge badge-pill bg-soft-primary text-primary me-2">
                                                    <span>On Progress</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bid->lot->end_time <= $current_time)
                                                @if (DB::table('bids')->select('user_id')->where('lot_id',$bid->lot->id)->orderBy('bid_price', 'DESC')->first()->user_id==Auth::id())
                                                <button type="button" class="btn btn-sm btn-outline-success">Pay</button>
                                                @else
                                                <button type="button" class="btn btn-sm btn-outline-secondary" disabled>You Lose</button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                </div>
            </div> --}}
        </div>
    </main>
</div>
@endsection
