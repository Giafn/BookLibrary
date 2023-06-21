@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="#" class="text-dark"><small>ListBook</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{session('error')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{$error}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-header">
                    <h3><b>Book List</b></h3>
                </div>
                <div class="card-body">
                    <a href="{{route('admin.addBook')}}" class="btn btn-primary mb-3">Add Book</a>
                    <a href="{{url('/admin/category')}}" type="button" class="btn btn-primary mb-3" >
                        Category
                    </a>
                    <a href="{{url('/admin/drive')}}" type="button" class="btn btn-primary mb-3" >
                        Drive
                    </a>
                    {{-- table --}}
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
                            @forelse ($books as $book)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->publisher}}</td>
                                <td>{{$book->category}}</td>
                                <td>
                                    {{-- btn show image --}}
                                    <a class="btn btn-primary showimage" data-id="{{$book->id}}"><i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="editbook btn btn-warning me-1" data-id="{{$book->id}}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{url('/admin/deleteBook/'. $book->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="deletebtn btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                              </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Empty</td>
                            </tr>
                            @endforelse
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
            <div class="modal-body d-flex justify-content-center" style="height: 27rem">
                <img id="imageshow" src="" alt="" class="w-100">
            </div>
          </div>
        </div>
    </div>
    <!-- end modal show image -->

    {{-- modal edit --}}
    <div class="modal fade" id="editbook" tabindex="-1" aria-labelledby="editbookLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                {{-- form edit --}}
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Book Title</label>
                                        <input type="text" class="form-control" id="title" name="title" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author">
                                    </div>
                                    <div class="mb-3">
                                        <label for="publisher" class="form-label">Publisher</label>
                                        <input type="text" class="form-control" id="publisher" name="publisher">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        {{-- selec category --}}
                                        <select name="category" id="category" class="form-select">

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="copies" class="form-label">copies</label>
                                        <input type="text" class="form-control" id="copies" name="copy">
                                    </div>
                                    <div class="mb-3">
                                        <label for="year" class="form-label">year</label>
                                        <input type="text" class="form-control" id="year" name="year">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">description</label>
                                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-center" style="width: 100%">
                            <img id="previewImage" src="" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

@endsection
@push('Scripts')
    <script>
        // data table
        $(document).ready(function() {
            $('.table').DataTable();
        } );
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

        $('.editbook').on('click', function(e){
            let id = $(this).data('id');
            $('#loader').removeClass('d-none');
            $.ajax({
                url: "{{url('/admin/editBook')}}"+"/"+id,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    let linkImage = data.link;
                    let category = data.category;
                    data = data.data;
                    console.log(data);
                    $('#loader').addClass('d-none');
                    $('#editbook form').attr('action', "{{url('/admin/updateBook')}}"+"/"+id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                    $('#publisher').val(data.publisher);
                    $('#copies').val(data.copies);
                    $('#year').val(data.publication_year);
                    $('#description').val(data.description);
                    $('#previewImage').attr('src', linkImage);
                    // loop option category
                    $.each(category, function(key, value){
                        if(value.name == data.category){
                            $('#category').append(`
                                <option value="${value.name}" selected>${value.name}</option>
                            `);
                            return;
                        } else {
                            $('#category').append(`
                                <option value="${value.name}">${value.name}</option>
                            `);
                        }
                    });

                    $('#editbook').modal('show');
                },
                error: function(){
                    $('#loader').addClass('d-none');
                    alert("error");
                }
            });
        });

        $('#image').on('change', function(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(){
                $('#previewImage').attr('src', reader.result);
            }
        });

        // on click delete button
        $('.deletebtn').on('click', function(e){
            e.preventDefault();
            let form = $(this).parent();
            if(confirm('Are you sure to delete?')){
                form.submit();
            }
        });

    </script>
@endpush
