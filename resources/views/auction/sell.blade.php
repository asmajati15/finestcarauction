@extends('auction/layout')

@section('title')
Finestcarauction - Sell Lots
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
                        <h1 class="h2 mb-0 ls-tight">Sell Lot</h1>
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
                <h5 class="mb-0">Applications</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Start Price</th>
                            <th scope="col">Current Bid</th>
                            <th scope="col">Bid Created</th>
                            <th scope="col">Bid End</th>
                            <th scope="col">Status</th>
                            <th></th>
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
                                <a class="text-heading font-semibold" href="{{ route('lot.show',$lot->id) }}"> {{$lot->name}} </a>
                            </td>
                            <td>
                                Rp{{number_format($lot->start_price)}}
                            </td>
                            <td>
                                Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}
                            </td>
                            <td>
                                {{date('d M Y, h:m A e', strtotime($lot->created_at));}}
                            </td>
                            <td>
                                {{date('d M Y, h:m A e', strtotime($lot->end_time));}}
                            </td>
                            <td>
                                <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                    <span>Sold</span>
                                </span>
                            </td>
                            <td class="text-end"> 
                                {{-- <a class="btn btn-primary" href="{{ route('lot.edit',$lot->id) }}">Edit</a> --}}
                                <a class="btn btn-sm btn-square btn-neutral" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-url="{{ route('lot.update',$lot->id) }}" data-name="{{ $lot->name }}" data-description="{{ $lot->description }}" data-min_price="{{ $lot->min_price }}" data-max_price="{{ $lot->max_price }}" data-buyout_price="{{ $lot->buyout_price }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('lot.destroy',$lot->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-neutral" onclick="return confirm('Are you sure want to delete this lot?')">
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
                <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
            </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('lot.store') }}" method="post" enctype="multipart/form-data">
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
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
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
                        <input class="form-control" type="file" id="formFileMultiple" multiple accept="image/*" name="image">
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
@endsection

@section('js')
<script>    
    var today = new Date().toISOString().slice(0, 16);

    document.getElementsByName("end_time")[0].min = today;
</script>
@endsection