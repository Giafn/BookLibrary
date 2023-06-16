@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
            <li><a href="#"><small>Detail</small></a></li>
            <li><a href="#"><small>Avengers</small></a></li>
        </ul>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="https://media.defense.gov/2013/Feb/20/2000074330/1200/1200/0/130220-F-ZZ999-002.JPG" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col-md-7 offset-md-1 py-2">
                        <h2>Avengers</h2>
                        <p>Description: Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum reprehenderit eum vitae quo facilis aspernatur ducimus inventore repudiandae debitis, laudantium saepe quidem temporibus accusamus expedita perspiciatis modi ea, libero quaerat.</p>
                        <div class="d-flex justify-content-between">
                            <p>Author: Stan Lee</p>
                            <p>Category: Comic</p>
                            <p>Published: 2012</p>
                            <p>ISBN: 123456789</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Language: English</p>
                            <p>Pages: 100</p>
                            <p>Rating: 4.5</p>
                            <p>Stock: 10</p>
                        </div>
                        <p>Price: Rp. 100.000</p>
                        <div class="d-flex">
                            <button class="btn btn-primary me-2">Borrow</button>
                            <button class="btn btn-success">Add to Favorites</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush