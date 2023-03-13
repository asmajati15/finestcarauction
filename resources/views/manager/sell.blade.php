@extends('layouts/admin')

@section('title')
Finestcarauction Manager - Sell Lots
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
                        <h1 class="h2 mb-0 ls-tight">Sell Lots</h1>
                    </div>
                    <!-- Actions -->
                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            <button type="button" class="btn d-inline-flex btn-sm blue-800 mx-1" data-bs-toggle="modal" data-bs-target="#AddModal">
                                <span class=" pe-2">
                                    <i class="bi bi-plus"></i>
                                </span>
                                <span>Create</span>
                            </button>
                        </div>
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
                <h5 class="mb-0">Lot Items</h5>
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lots as $lot)
                        {{-- @if ($lot->user->level == 0) --}}
                        {{-- @if (auth()->user()->id == $lot->user_id) --}}

                        {{-- @dd($lot) --}}
                        {{-- @dd(DB::table('bids')->where('lot_id',5)->orderBy('bid_price','DESC')->get()) --}}
                        <tr>
                            <p hidden>{{ $lot->tracking_number }}</p>
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
                                @switch($lot->status)
                                    @case(1)
                                        <span class="badge badge-pill bg-soft-primary text-primary me-2">
                                            <span>On Progress</span>
                                        </span>
                                        @break
                                    @case(2)
                                        <span class="badge badge-pill bg-soft-warning text-warning me-2">
                                            <span>Pending</span>
                                        </span>
                                        @break
                                    @case(3)
                                        <span class="badge badge-pill bg-soft-secondary text-secondary me-2">
                                            <span>Archived</span>
                                        </span>
                                        @break
                                    @default
                                    <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                        <span>Ends</span>
                                    </span>
                                @endswitch
                            </td>
                            <td class="text-end">
                                @switch($lot->status)
                                    @case(1)
                                        <form action="{{ route('manager.lot.close',$lot->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-warning" name="status" value="0" onclick="return confirm('Are you sure want to close this lot?')">
                                                Close
                                            </button>
                                        </form>
                                        @break
                                    @case(2)
                                        <form action="{{ route('manager.lot.statusUp',$lot->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-info" name="status" value="1" onclick="return confirm('Are you sure want to resume this lot?')">
                                                Resume
                                            </button>
                                        </form>
                                        @break
                                    @case(3)
                                        <form action="{{ route('manager.lot.statusUp',$lot->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="status" value="0" onclick="return confirm('Are you sure want to unarchive this lot?')">
                                                Unarchive
                                            </button>
                                        </form>
                                        @break
                                    @default
                                    <a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#OpenModal" data-url="{{ route('manager.lot.open',$lot->id) }}" data-end_time="{{ $lot->end_time }}">
                                        Open
                                    </a>
                                @endswitch
                                <a class="btn btn-sm btn-square btn-outline-success" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-url="{{ route('manager.lot.update',$lot->id) }}" data-name="{{ $lot->name }}" data-description="{{ $lot->description }}" data-start_price="{{ $lot->start_price }}" data-bid_increment="{{ $lot->bid_increment }}" data-end_time="{{ $lot->end_time }}" data-image="/lot-images/{{ $lot->image }}" data-tracking_number="{{ $lot->tracking_number }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('manager.lot.destroy',$lot->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-outline-danger" onclick="return confirm('Are you sure want to delete this lot?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer border-0 py-5">
                <span class="text-muted text-sm">Showing 10 items out of 350 results found</span>
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
                        <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id">
                            <option hidden>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
                        <input class="dropify @error('image') is-invalid @enderror" type="file" id="formFileMultiple" multiple accept="image/*" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg">
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
                        <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Default select example" name="category_id">
                            <option hidden>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" aria-label="Default select example" name="status">
                            <option hidden>Select Status</option>
                                <option value="0">Close</option>
                                <option value="1">Open</option>
                                <option value="2">Pending</option>
                                <option value="3">Archived</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Tracking Number</label>
                        <input type="number" min="1000000000" max="9999999999" class="form-control @error('tracking_number') is-invalid @enderror" name="tracking_number"  value="${$(e.relatedTarget).data('tracking_number')}">
                        @error('tracking_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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

    $('.dropify').dropify();
</script>
@endsection
