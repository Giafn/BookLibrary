@extends('layouts.app')

@section('content')
    <div class="row ms-2 ps-2 g-2">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
        </ul>
        <h3>Popular</h3>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-1">
                    <img src="https://legendary-digital-network-assets.s3.amazonaws.com/wp-content/uploads/2020/05/13042136/6295174-house-of-m-avengers-1.jpg" class="img-fluid w-100" alt="">
                    <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                        <h5>Avengers</h5>
                        <h5>9.4</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-body p-1">
                    <img src="https://media.defense.gov/2013/Feb/20/2000074330/1200/1200/0/130220-F-ZZ999-002.JPG" class="img-fluid w-100" alt="">
                    <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                        <h5>Avengers</h5>
                        <h5>9.4</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-body p-1">
                    <img src="https://www.tuscaloosanews.com/gcdn/authoring/2015/02/06/NTTN/ghows-DA-a600ed26-006f-4675-8228-4e7895040c1e-7184bee6.jpeg" class="img-fluid w-100" alt="">
                    <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                        <h5>Avengers</h5>
                        <h5>9.4</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ms-2 ps-2 pt-3 g-2">
        <hr>
        <div class="d-flex">
            <h3>Genre : Comic</h3>
            <a href="#" class="ms-auto me-2">See All</a>
        </div>
        <div class="col">
            <div class="swiper">
                <div class="swiper-wrapper">
                @foreach ($book['Comic'] as $item)
                  <div class="swiper-slide" data-id="{{$item->id}}">
                    <div class="card">
                        <div class="card-body p-1">
                            <img src="https://drive.google.com/uc?id={{$drive['location/'.$item->image]->first()['extraMetadata']['id']}}" class="img-fluid w-100" alt="">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>{{$item->title}}</h5>
                                <h5>9.4</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                @endforeach
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
              </div>
        </div>
    </div>
    <div class="row ms-2 ps-2 pt-3 g-2">
        <hr>
        <div class="d-flex">
            <h3>Genre : Action</h3>
            <a href="#" class="ms-auto me-2">See All</a>
        </div>
        <div class="col">
            <div class="swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="card">
                        <div class="card-body p-1">
                            <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-book-cover-design-template-ea06579b69a398ba7d4fc845e80fcd66_screen.jpg?ts=1673708846" class="img-fluid w-100" alt="">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>Warior</h5>
                                <h5>9.4</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card">
                        <div class="card-body p-1">
                            <img src="https://cdn2.penguin.com.au/covers/400/9781760896713.jpg" class="img-fluid w-100" alt="">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>The Investigator</h5>
                                <h5>9.4</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card">
                        <div class="card-body p-1">
                            <img src="https://m.media-amazon.com/images/I/51GUbgV2M5L._SX296_BO1,204,203,200_.jpg" class="img-fluid w-100" alt="">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>Missing in action</h5>
                                <h5>9.4</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card">
                        <div class="card-body p-1">
                            <img src="https://cdn.penguin.co.uk/dam-assets/books/9780241402900/9780241402900-jacket-medium.jpg" class="img-fluid w-100" alt="">
                            <div class="d-flex justify-content-between align-items-center mx-2 flex-coulumn mt-2">
                                <h5>The Last Orphan</h5>
                                <h5>9.4</h5>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
              </div>
        </div>
    </div>
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
    const card = document.querySelectorAll('.card');
    card.forEach((card) => {
        card.addEventListener('click', () => {
            window.location.href = "{{ route('book.all') }}";
        });
    });
</script>
@endpush
