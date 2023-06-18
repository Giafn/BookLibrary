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
                                {{-- <td><img src="https://drive.google.com/uc?id={{$drive['location/'.$book->image]->first()['extraMetadata']['id']}}" alt="" width="100px"></td> --}}
                                <td>
                                    {{-- btn show image --}}
                                    <a class="btn btn-primary showimage" data-id="{{$book->id}}"><i class="fas fa-image"></i>
                                        Show Image
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('/book/edit')}}" class="btn btn-warning">Edit</a>
                                    <form action="{{url('/admin/deleteBook/'. $book->id)}}" method="POST" class="d-inline">
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

    {{-- modal show image --}}
    <div class="modal fade" id="showimage" tabindex="-1" aria-labelledby="showimageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-body">
                <img id="imageshow" src="" alt="" width="100%">
            </div>
          </div>
        </div>
    </div>
    <!-- end modal show image -->

@endsection
@push('Scripts')
    <script>
        $('.showimage').on('click', function(e){
            let id = $(this).data('id');
            // remove d-none loader div
            $('#loader').removeClass('d-none');

            $.ajax({
                url: "{{url('/admin/show')}}"+"/"+id,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    $('#imageshow').attr('src', data);
                    $('#loader').addClass('d-none');
                    $('#showimage').modal('show');
                },
                error: function(){
                    alert("error");
                }
            });
        });
    </script>
@endpush
