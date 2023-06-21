@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="#" class="text-dark"><small>Lost Book</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
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
            <div class="card">
                <div class="card-header">
                    <h3><b>Lost Book</b></h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">category</th>
                            <th scope="col">member name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($lost as $book)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$book->title}}</td>
                                <td>{{$book->category}}</td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->date_borow}}</td>
                                <td>
                                    @if ($book->status == 2)
                                        <span class="badge bg-danger">Lost</span>
                                    @elseif ($book->status == 3)
                                        <span class="badge bg-warning">Paid fine</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if ($book->status != 3)
                                        <a class="setpaid btn btn-warning me-1" data-id="{{$book->id}}">
                                            <i class="bi bi-cash-coin"></i>
                                        </a>
                                        @endif
                                        <a class="setBack btn btn-dark me-1" data-id="{{$book->id}}">
                                            <i class="bi bi-journal-arrow-down"></i>
                                        </a>
                                    </div>
                                </td>
                              </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('Scripts')
<script>
    // set paid
    $('.setpaid').on('click', function () {
        let id = $(this).data('id');
        // if confirm
        if(confirm('Are you sure, to set paid?')){
            $.ajax({
                url: '{{url("/admin/lostBook/setpaid")}}'+'/'+id,
                method: 'GET',
                data: {
                    _token: '{{csrf_token()}}',
                },
                success: function(data){
                    if(data.success){
                        alert(data.success);
                        location.reload();
                    }else{
                        alert(data.error);
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });

    // set back
    $('.setBack').on('click', function () {
        let id = $(this).data('id');
        // if confirm
        if(confirm('Are you sure, to set Back the Book?')){
            $.ajax({
                url: '{{url("/admin/lostBook/setBack")}}'+'/'+id,
                method: 'GET',
                data: {
                    _token: '{{csrf_token()}}',
                },
                success: function(data){
                    if(data.success){
                        alert(data.success);
                        location.reload();
                    }else{
                        alert(data.error);
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });
</script>
@endpush
