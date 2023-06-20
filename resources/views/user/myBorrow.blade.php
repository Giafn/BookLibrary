@extends('layouts.app')

@section('content')
<div class="container ms-2">
    <ul class="breadcrumb">
        <li><a href="/"><small>Home</small></a></li>
        <li><a href="#"><small>Borrowed</small></a></li>
    </ul>
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
    <div class="row">
        @forelse ($book as $book)
        <div class="col-12" data-bs-theme="light">
            <div class="card my-2 @if($book->status != null) bg-secondary @endif" data-id="{{$book->id}}">
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2 @if ($book->status != null) text-white @endif">
                        <div class="wrapper">
                            <h4>{{$book->title}}</h4> <small class="text-white d-md-block"> - by {{$book->author}}</small>
                        </div>
                        @if($book->status != null)
                        <p>not yet approved</p>
                        <form id="formCancel" action="{{url('/cancelBorrow/'.$book->id)}}" method="get">
                            @csrf
                            <button type="submit" class="btn"><i class="bi bi-x-circle-fill text-white"></i></button>
                        </form>
                        @else
                        <p><span class="d-md-block d-none">must back in</span><span class="d-md-none d-block">to </span><small>{{$book->date_return}}</small></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <h4>you haven't borrowed any book</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush