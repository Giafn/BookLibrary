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
                              <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" value="{{old('title')}}">
                              @if ($errors->has('title'))
                                <span class="text-danger">{{$errors->first('title')}}</span>
                              @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="Author" value="{{old('author')}}">
                                @if ($errors->has('author'))
                                    <span class="text-danger">{{$errors->first('author')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Publisher" value="{{old('publisher')}}">
                                @if ($errors->has('publisher'))
                                    <span class="text-danger">{{$errors->first('publisher')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">year</label>
                                <input type="text" class="form-control" id="year" name="year" placeholder="year" value="{{old('year')}}">
                                @if ($errors->has('year'))
                                    <span class="text-danger">{{$errors->first('year')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="category" name="category">
                                    <option value="0">Open this select menu</option>
                                    @foreach ($category as $item)
                                        @if ($item->name == old('category'))
                                            <option value="{{$item->name}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{$errors->first('category')}}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control " id="image" name="image" placeholder="Image" value="{{old('image')}}">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{$errors->first('image')}}</span>
                                @endif
                            </div>
                            <div class="col-10 mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="description">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="copy" class="form-label">copy</label>
                                <input type="number" class="form-control" id="copy" name="copy" placeholder="copy" value="{{old('copy')}}">
                                @if ($errors->has('copy'))
                                    <span class="text-danger">{{$errors->first('copy')}}</span>
                                @endif
                            </div>
                        </div>
                        <button id="sub" type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
<script>
    $('#sub').click(function () {
        $('.loader').removeClass('d-none');

    });
</script>
@endpush
