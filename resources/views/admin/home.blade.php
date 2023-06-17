@extends('layouts-admin.app')

@section('content')
    <div class="row g-3 ps-3">
        <div class="col-md-7">
            <div class="card" style="background-color: #F7E6C4">
                <div class="card-body">
                    <img src="{{url('/img/admin/sayhay.png')}}" class="float-end" alt="">
                    <h3><b>Hai {{Auth::user()->name}}</b></h3>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card" style="background-color: #F7E6C4">
                <div class="card-body">
                    <div class="text-md-end text-center">
                        <h3>Today Borrow</h3>
                        <h1 class="display-5"><b>0</b></h1>
                        <h4>book borrowed</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="background-color: #F7E6C4">
                <div class="card-body">
                    <div class="text-md-start text-center">
                        <h3>Today back</h3>
                        <h1 class="display-5"><b>0</b></h1>
                        <h4>Book</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="background-color: #F7E6C4">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Must returned today</h3>
                        <h1 class="display-5"><b>0</b></h1>
                        <h4>Book</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
@endpush
