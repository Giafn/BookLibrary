@extends('layouts.app')

@section('content')
    <div class="container ms-2">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
            <li><a href="#"><small>filter</small></a></li>
            <li><a href="#"><small>{{$search}}</small></a></li>
        </ul>
        <div class="row mb-2 ps-2 g-2">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Category
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($allcategory as $allcat)
                        <li><a class="dropdown-item" href="{{url('/category/'.$allcat->id)}}">{{$allcat->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row g-2">
            <hr>
            @forelse ($book as $b)
            <div class="col-md-3 col-6">
                <a href="{{url('/detail/'.$b->id)}}?image=https://drive.google.com/uc?id={{$drive['location/'.$b->image]->first()['extraMetadata']['id']}}">
                    <div class="card" data-id="{{$b->id}}" data-image="https://drive.google.com/uc?id={{$drive['location/'.$b->image]->first()['extraMetadata']['id']}}">
                        <div class="card-body p-1">
                            <img src="https://drive.google.com/uc?id={{$drive['location/'.$b->image]->first()['extraMetadata']['id']}}" class="img-fluid w-100" alt="" loading="lazy">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>{{$b->title}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center">
                <h4>no book found</h4>
            </div>
            @endforelse
        </div>
        <div class="row mt-2">
            {{$book->links()}}
        </div>
@endsection
@push('scripts')
{{-- jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- swiper --}}
<script>
    $(document).ready(function(){
        // set height card
        $('.img-fluid').parent().parent().css('height', '21.75em');
        $('.img-fluid').parent().parent().css('background-color', '#868e96');
    });
    // unset height card
    $('.img-fluid').on('load', function(){
        $(this).parent().parent().css('height', '');
        $(this).parent().parent().css('background-color', '');
    });
</script>
@endpush