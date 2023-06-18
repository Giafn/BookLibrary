@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="#" class="text-dark"><small>ListBook</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3><b>Book List</b></h3>
                </div>
                <div class="card-body">
                    <a href="{{route('admin.addBook')}}" class="btn btn-primary mb-3">Add Book</a>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">category</th>
                            <th scope="col">image</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->publisher}}</td>
                                <td>{{$book->category}}</td>
                                <td><img src="{{$book->image}}" alt="" width="100px"></td>
                                <td>
                                    <a href="{{url('/book/edit')}}" class="btn btn-warning">Edit</a>
                                    <form action="{{url('/book/destroy', $book->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
@endpush
