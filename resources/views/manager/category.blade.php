@extends('layouts/admin')

@section('title')
Finestcarauction Manager - Category List
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
                        <h1 class="h2 mb-0 ls-tight">Category</h1>
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
                <h5 class="mb-0">Category List</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Category Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>
                                <p class="text-heading font-semibold">{{$category->name}}</p>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-square btn-outline-success" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-url="{{ route('manager.category.update',$category->id) }}" data-name="{{ $category->name }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('manager.category.destroy',$category->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-square btn-outline-danger" onclick="return confirm('Are you sure want to delete this category?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
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

<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('manager.category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add category name</h5>
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
@endsection

@section('js')
<script>
    $('#UpdateModal').on('shown.bs.modal', function(e) {
        var html = `
            <div class="modal-header">
                <h5 class="modal-title">Edit category name</h5>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue-800">Submit</button
                </div>
            </form>
            `;
        $('#modal-content').html(html);
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
