@extends('layouts.app')

@section('content')
    <div class="container ms-2">
        <ul class="breadcrumb">
            <li><a href="/"><small>Home</small></a></li>
            <li><a href="#"><small>Detail</small></a></li>
            <li><a href="#"><small>Avengers</small></a></li>
        </ul>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{request()->image}}" class="img-fluid w-100" alt="">
                    </div>
                    <div class="col-md-7 offset-md-1 py-2">
                        <h2>{{$data->title}}</h2>
                        <p>Description: {{$data->description}}</p>
                        <div class="d-flex justify-content-between">
                            <p>Author: {{$data->author}}</p>
                            <p>Category: {{$data->category}}</p>
                            <p>Published: {{$data->publication_year}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Stock: {{$data->copies}}</p>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBorrow">
                                Borrow
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBorrow" tabindex="-1" aria-labelledby="modalBorrowLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                {{-- for borrow --}}
                <form id="formBorrow" action="{{url('/borrow/'.$data->id)}}" method="POST">
                    @csrf
                    <h4>Borrow book => {{$data->title}}</h4>
                    <div class="mb-3">
                        <label for="borrow_date" class="form-label">Borrow Date</label>
                        <input type="date" class="form-control" id="borrow_date" value="{{date('Y-m-d')}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Return Date</label>
                        <input type="date" class="form-control" id="return_date" name="date_return">
                        <span>peminjaman hanya dapat di lakukan di hari yang sama dengan pemesanan pinjam buku di website</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
</script>
@endpush