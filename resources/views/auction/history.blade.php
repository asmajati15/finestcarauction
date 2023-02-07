@extends('auction/layout')

@section('title')
Detail
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
                <h5 class="mb-0">Applications</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Bid Date</th>
                            <th scope="col">Bid End</th>
                            <th scope="col">Your Bid</th>
                            <th scope="col">Final Bid</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img alt="..." src="{{asset('image/item1.jpg')}}" class="avatar avatar-sm rounded-circle me-2">
                                <a class="text-heading font-semibold" href="#"> ZHOU GUANYU 2022 SIGNED OFFICIAL REPLICA HELMET </a>
                            </td>
                            <td>
                                Feb 7, 2023
                            </td>
                            <td>
                                Feb 10, 2023
                            </td>
                            <td>
                                Rp140.000.000
                            </td>
                            <td>
                                Rp140.000.000
                            </td>
                            <td>
                                <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                    <span>Sold</span>
                                </span>
                            </td>
                        </tr>
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