@extends('layouts/home')

@section('title')
Finestcarauction Manager - Dashboard
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
                <h5 class="mb-0">Lot Items</h5>
                <div class="text-end" style="margin-top: -20px;"><button class="btn btn-sm blue-800-outline">Export PDF</button></div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Start Price</th>
                            <th scope="col">Current Bid</th>
                            {{-- <th scope="col">Bid Created</th> --}}
                            <th scope="col">Bid End</th>
                            <th scope="col">Bid Winner</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lots as $lot)
                        {{-- @if ($lot->user->level == 0) --}}
                        {{-- @if (auth()->user()->id == $lot->user_id) --}}

                        {{-- @dd($lot) --}}
                        {{-- @dd(DB::table('bids')->where('lot_id',5)->orderBy('bid_price','DESC')->get()) --}}
                        <tr>
                            <td>
                                <img alt="{{$lot->name}}" src="/lot-images/{{ $lot->image }}"  class="avatar avatar-sm rounded-circle me-2">
                                <a class="text-heading font-semibold" href="{{ route('manager.lot.show',$lot->id) }}" style="display: inline-block; width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> {{$lot->name}} </a>
                            </td>
                            <td>
                                Rp{{number_format($lot->start_price)}}
                            </td>
                            <td>
                                Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}
                            </td>
                            {{-- <td>
                                {{date('d M Y, h:m A e', strtotime($lot->created_at));}}
                            </td> --}}
                            <td>
                                {{date('d M Y, H:m', strtotime($lot->end_time));}}
                            </td>
                            <td>
                                @if ($lot->user_id === NULL)
                                    <span class="text-danger">No one bid yet</span>
                                @else
                                    {{ $lot->user->name }}
                                @endif
                            </td>
                            <td>
                                @if ($lot->status === 0)
                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                        <span>Ends</span>
                                    </span>
                                @else
                                    <span class="badge badge-pill bg-soft-primary text-primary me-2">
                                        <span>On Progress</span>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        {{-- @endif --}}
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

<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('manager.lot.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Lot Item to Auction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option hidden>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"  value="{{ old('description') }}">
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Start Price</label>
                            <input type="number" class="form-control @error('start_price') is-invalid @enderror" name="start_price" value="{{ old('start_price') }}">
                            @error('start_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- <div class="col-sm-4">
                            <label class="form-label">Max Price</label>
                            <input type="number" class="form-control @error('max_price') is-invalid @enderror" name="max_price" value="{{ old('max_price') }}">
                            @error('max_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        <div class="col-sm-6">
                            <label class="form-label">Bid Increment</label>
                            <input type="number" class="form-control @error('bid_increment') is-invalid @enderror" name="bid_increment" value="{{ old('bid_increment') }}">
                            @error('bid_increment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}">
                        @error('end_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="formFileMultiple" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFileMultiple" multiple accept="image/*" name="image">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn blue-800" name="save" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modal-content">
        </div>
    </div>
</div>

<div class="modal fade" id="OpenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modal-content2">
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var today = new Date().toISOString().slice(0, 16);

    document.getElementsByName("end_time")[0].min = today;

    $('#UpdateModal').on('shown.bs.modal', function(e) {
        var html = `
            <div class="modal-header">
                <h5 class="modal-title">Edit Lot Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="${$(e.relatedTarget).data('name')}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option hidden>Select Category</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"  value="${$(e.relatedTarget).data('description')}">
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Start Price</label>
                            <input type="number" class="form-control @error('start_price') is-invalid @enderror" name="start_price" value="${$(e.relatedTarget).data('start_price')}">
                            @error('start_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Bid Increment</label>
                            <input type="number" class="form-control @error('bid_increment') is-invalid @enderror" name="bid_increment" value="${$(e.relatedTarget).data('bid_increment')}">
                            @error('bid_increment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="${$(e.relatedTarget).data('end_time')}">
                        @error('end_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="formFileMultiple" class="form-label">Image</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple accept="image/*" name="image" value="${$(e.relatedTarget).data('image')}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue-800">Submit</button
                </div>
            </form>
            `;
        $('#modal-content').html(html);
    });

    $('#OpenModal').on('shown.bs.modal', function(e) {
        var html = `       
            <div class="modal-header">
                <h5 class="modal-title">Open this lot to auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                        <input type="hidden" name="status" value="1">
                    <div class="row mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="${$(e.relatedTarget).data('end_time')}">
                        @error('end_time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue-800">Submit</button>
                </div>
            </form>
            `;
        $('#modal-content2').html(html);
    });

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
