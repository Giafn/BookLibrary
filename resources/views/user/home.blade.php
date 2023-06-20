@extends('layouts.app')

@section('content')
    <div class="row ms-2 ps-2 g-2">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
        </ul>
    </div>
    {{-- dropdown pilih category --}}
    <div class="row ms-2 ps-2 g-2">
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

    @foreach ($list as $l)
    <div class="row ms-2 ps-2 pt-3 g-2">
        <hr>
        <div class="d-flex">
            <h3>Genre : {{$l}}</h3>
            <a href="{{url('/category/'.$l)}}" class="ms-auto me-2">See All</a>
        </div>
        <div class="col">
            <div class="swiper">
                <div class="swiper-wrapper">
                @php
                    $bookCount = count($book[$l]);
                    $stop_at = $bookCount - $bookCount%4;
                    if ($stop_at > 8) {
                        $stop_at = 8;
                    }
                    $i = 1;
                    $shuffled = $book[$l]->shuffle();
                @endphp
                @foreach ($shuffled as $item)
                  <div class="swiper-slide card-item" data-id="{{$item->id}}" data-image="https://drive.google.com/uc?id={{$drive['location/'.$item->image]->first()['extraMetadata']['id']}}">
                    <div class="card" data-id="{{$item->id}}">
                        <div class="card-body p-1">
                            <img src="https://drive.google.com/thumbnail?authuser=0&sz=w320&id={{$drive['location/'.$item->image]->first()['extraMetadata']['id']}}" class="img-fluid w-100" alt="{{$item->image}}" loading="lazy">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>{{$item->title}}</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                  @if ($i == $stop_at)
                    @break
                  @endif
                  @php
                    $i++;
                  @endphp
                @endforeach
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
              </div>
        </div>
    </div>
    @endforeach
@endsection
@push('Scripts')
<script>
    const swiper = new Swiper('.swiper', {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
        },
        breakpoints: {
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        },
    });
    // onclick .card
    $('.card-item').click(function(){
        window.location.href = '/detail/'+$(this).data('id')+'?image='+$(this).data('image');
    });
    // document ready
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
