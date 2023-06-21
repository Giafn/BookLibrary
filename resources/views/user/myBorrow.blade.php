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
        @php
            $now = strtotime(date('Y-m-d'));
            $date = strtotime(date('Y-m-d', strtotime($book->date_return)));
            if ($date < $now || $book->status == 2) {
                $status = 'bg-danger';
            } else {
                $status = 'bg-warning';
            }
        @endphp
        <div class="col-12" data-bs-theme="light">
            <div class="card my-2 @if($book->status == 1) bg-secondary @else {{$status}} @endif  position-relative" data-id="{{$book->id}}">
                <div class="card-body p-1">
                    <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2 @if ($book->status !== null) text-white @endif">
                        <div class="wrapper">
                            <h4>{{$book->title}}</h4> <small class="d-md-block"> - by {{$book->author}}</small>
                        </div>
                        @if($book->status == 1)
                        <p>not yet approved</p>
                        <form id="formCancel" action="{{url('/cancelBorrow/'.$book->id)}}" method="get">
                            @csrf
                            <button type="submit" class="btn position-absolute top-0 start-100 translate-middle"><i class="bi bi-x-circle-fill text-white"></i></button>
                        </form>
                        @else
                        @if ($book->status == 2)
                        <p>LOST-obliged to pay a fine</p>
                        @else
                        <p><span class="d-md-block d-none">must back in</span><span class="d-md-none d-block">to </span><small>{{$book->date_return}}</small></p>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalLost-{{$book->id}}">
                            <i class="bi bi-bookmark-x-fill"></i>
                        </button>
                        @endif
                        {{-- modal --}}
                        <div class="modal fade" id="modalLost-{{$book->id}}" tabindex="-1" aria-labelledby="modalLostLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5>Are you sure you want to report this book "{{$book->title}}" as lost?</h5>
                                    <p>you will be charged a fine</p>
                                    <a href="{{url('/setLost/'.$book->id)}}" class="btn btn-primary">Yes</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">no</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- end modal --}}
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
@endpush