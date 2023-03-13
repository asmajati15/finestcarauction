@extends('layouts/user')

@section('title')
Finestcarauction - History
@endsection

@section('main-content')
    <!-- Main -->
    <div class="bg-surface-secondary">
        <div class="container-fluid" style="margin-top: 5%">
            <main class="pt-7 pb-2">
                <div class="container-fluid">
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Your Bid History</h5>
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
                                    @foreach ($bids as $bid)
                                    @if (Auth::id() == $bid->user_id )
                                    <tr>
                                        <td>
                                            <img alt="{{$bid->lot->name}}" src="/lot-images/{{ $bid->lot->image }}" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-heading font-semibold" href="{{ route('lot.show',$bid->lot->id)}}" style="display: inline-block; width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> {{$bid->lot->name}} </a>
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
                                                    @if ($bid->payment_status == '200')
                                                    <a href="https://www.dhl.com/id-en/home/tracking/tracking-parcel.html?submit=1&tracking-id={{ $bid->lot->tracking_number }}" class="btn btn-square btn-sm btn-outline-success"><i class="bi bi-truck"></i></a>
                                                    <a href="{{ route('bid.invoice',$bid->lot->id) }}" class="btn btn-square btn-sm btn-outline-primary"><i class="bi bi-receipt"></i></a>
                                                    @else
                                                    <a href="{{ route('lot.show',$bid->lot->id)}}" class="btn btn-sm btn-outline-success">Pay</a>
                                                    @endif
                                                @else
                                                <button type="button" class="btn btn-sm btn-outline-secondary" disabled>You Lose</button>
                                                @endif
                                            @else
                                                <form action="{{ route('bid.destroy',$bid->lot->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @else
                                    @endif
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
    </div>
@endsection

@section('js')
    <script>
        @if(session()->has('success'))
        Swal.fire(
        'Success',
        '{{ session('success') }}',
        'success'
        )
        @elseif(session()->has('error'))
        Swal.fire(
        'Something went wrong!',
        '{{ session('error') }}.',
        'error',
        )
        @endif
    </script>
@endsection
