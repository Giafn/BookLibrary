@extends('layouts.app')

@section('content')
    <div class="container ms-2">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
            <li><a href="#"><small>Borrowed</small></a></li>
        </ul>
        <div class="row">
            @forelse ($book as $book)
            <div class="col-12" data-bs-theme="light">
                <div class="card my-2 @if($book->status != null) bg-secondary @endif" data-id="{{$book->id}}">
                    <div class="card-body p-1">
                        <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                            <h4>{{$book->title}} <small class="text-muted"><br> - by {{$book->author}}</small></h4>
                            
                            @if($book->status != null)
                            <p>not yet approved</p>
                            {{-- btn cancel --}}
                            <form id="formCancel" action="{{url('/cancelBorrow/'.$book->id)}}" method="get">
                                @csrf
                                <button type="submit" class="btn"><i class="bi bi-x-circle-fill"></i></button>
                            </form>
                            @else
                            <h5 class="d-md-block d-none">must back in {{$book->date_return}}</h5>
                            <p>approved</p>
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