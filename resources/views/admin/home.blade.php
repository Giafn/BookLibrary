@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
    </ul>
    <div class="row g-3 ps-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <img src="{{url('/img/admin/sayhay.png')}}" class="float-end" alt="">
                    <h3><b>Hai {{Auth::user()->name}}</b></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Member total</h3>
                        <h1 class="display-5"><b>{{$countMember}}</b></h1>
                        <h4>Member</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <h3>All Book</h3>
                        <h1 class="display-5"><b>{{$allBook}}</b></h1>
                        <h4>Title of Book</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-md-start text-center">
                        <h3>Borrowed Book</h3>
                        <h1 class="display-5"><b>{{$borowNow}}</b></h1>
                        <h4>Book</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Must returned today</h3>
                        <h1 class="display-5"><b>{{$mustReturnToday}}</b></h1>
                        <h4>Book</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-md-end text-center">
                        <h3>Lost Book</h3>
                        <h1 class="display-5"><b>{{$lost}}</b></h1>
                        <h4>Book</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
@endpush
