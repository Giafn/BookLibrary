@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="/admin/bookList" class="text-dark"><small>ListBook</small></a></li>
        <li><a href="#" class="text-dark"><small>Add</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3><b>Add New Book</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.storeBook')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="title" class="form-label">Book Title</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Book Title">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="Author">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Publisher">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="category" name="category">
                                    <option selected>Open this select menu</option>
                                    <option value="Novel">Novel</option>
                                    <option value="Comic">Comic</option>
                                    <option value="Science">Science</option>
                                    <option value="History">History</option>
                                    <option value="Biography">Biography</option>
                                    <option value="Religion">Religion</option>
                                    <option value="Health">Health</option>
                                    <option value="Cooking">Cooking</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Children">Children</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
@endpush
