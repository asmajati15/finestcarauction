@extends('layouts/admin')

@section('title')
Finestcarauction Admin - Dashboard
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
                </div>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <!-- Card stats -->
            <div class="row g-6 mb-6">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Item</span>
                                    <span class="h3 font-bold mb-0">{{ DB::table('lots')->get()->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Categories</span>
                                    <span class="h3 font-bold mb-0">{{ DB::table('categories')->get()->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                        <i class="bi bi-hammer"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total User</span>
                                    <span class="h3 font-bold mb-0">{{ DB::table('users')->get()->count() }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Payed Item</span>
                                    <span class="h3 font-bold mb-0">Rp{{ number_format(DB::table('bids')->get()->sum('jumlah_pembayaran')) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                        <i class="bi bi-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">Auction Items</h5>
                <div class="text-end" style="margin-top: -20px;"><a href="{{ route('manager.lot.report') }}" class="btn btn-sm blue-800-outline">Export PDF</a></div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Bid End</th>
                            <th scope="col">Bid Winner</th>
                            <th scope="col">Highest Bid</th>
                            <th scope="col">Auction Status</th>
                            <th scope="col">Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bids as $bid)
                        <tr>
                            <td>
                                <img alt="{{$bid->lot->name}}" src="/lot-images/{{ $bid->lot->image }}" class="avatar avatar-sm rounded-circle me-2">
                                <a class="text-heading font-semibold" href="{{ route('admin.lot.show',$bid->lot->id)}}" style="display: inline-block; width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> {{$bid->lot->name}} </a>
                            </td>
                            <td>
                                {{date('d M Y, H:m', strtotime($bid->lot->end_time));}}
                            </td>
                            <td>
                                {{$bid->lot->user->name}}
                            </td>
                            <td>
                                Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$bid->lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}
                            </td>
                            <td>
                                @if ($bid->lot->end_time <= $current_time)
                                    <span class="badge badge-pill bg-soft-primary text-primary me-2">
                                        <span>End</span>
                                    </span>
                                @else
                                    <span class="badge badge-pill bg-soft-primary text-primary me-2">
                                        <span>On Progress</span>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @switch($bid->payment_status)
                                    @case('200')
                                        <span class="badge badge-pill bg-soft-success text-success me-2">
                                            <span>Success</span>
                                        </span>
                                        @break
                                    @case('201')
                                        <span class="badge badge-pill bg-soft-warning text-success me-2">
                                            <span>Pending</span>
                                        </span>
                                        @break
                                    @case('202')
                                        <span class="badge badge-pill bg-soft-danger text-success me-2">
                                            <span>Denied</span>
                                        </span>
                                        @break
                                    @default
                                    <span class="badge badge-pill bg-soft-secondary text-secondary me-2">
                                        <span>Not Payed/On Going</span>
                                    </span>
                                @endswitch
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
        </div>
    </main>
</div>
@endsection

@section('js')
<script>
    var today = new Date().toISOString().slice(0, 16);

    document.getElementsByName("end_time")[0].min = today;
</script>
@endsection
