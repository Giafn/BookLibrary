@extends('layouts-admin.app')

@section('content')
<ul class="breadcrumb-white breadcrumb">
    <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
    <li><a href="#" class="text-dark"><small>Borrowed</small></a></li>
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
                <h3><b>List borrowed</b></h3>
            </div>
            <div class="card-body">
                <a id="addborrowbutton" class="btn btn-primary mb-3">Add borrow</a>
                <a id="listrequestbutton" class="btn btn-primary mb-3">List request</a>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>nama buku</th>
                            <th>nama user</th>
                            <th>tanggal pinjam</th>
                            <th>tanggal kembali</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        @php
                            $now = strtotime(date('Y-m-d'));
                            $date = strtotime(date('Y-m-d', strtotime($item->date_return)));
                            if ($date < $now) {
                                $status = 'btn-dark';
                                $s = 'text-danger';
                            } else {
                                $status = 'btn-success';
                                $s = '';
                            }
                        @endphp
                        <tr>
                            <td><span class="{{$s}}">{{$loop->iteration}}</span></td>
                            <td><span class="{{$s}}">{{$item->book_title}}</span></td>
                            <td><span class="{{$s}}">{{$item->user_name}}</span></td>
                            <td><span class="{{$s}}">{{$item->date_borow}}</span></td>
                            <td><span class="{{$s}}">{{$item->date_return}}</span></td>
                            <td>
                                <div class="d-flex">
                                    <a class="save btn {{$status}} btn-sm" data-id="{{$item->id}}"><i class="bi bi-box-arrow-down"></i></a>
                                    @if ($status == 'btn-dark')
                                    <a class="setLost ms-1 btn btn-danger btn-sm" data-id="{{$item->id}}"><i class="bi bi-journal-x"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Data kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- modal add --}}
<div class="modal fade" id="addborow" tabindex="-1" aria-labelledby="addborowLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{url('/admin/borowBook/store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User</label>
                                {{-- selec user_id --}}
                                <select name="user_id" id="user_id" class="form-select">
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="book_id" class="form-label">Book</label>
                                {{-- selec book_id --}}
                                <select name="book_id" id="book_id" class="form-select">
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date_borow" class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="date_borow" id="date_borow" class="form-control" value="{{date('Y-m-d')}}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="date_return" class="form-label">Tanggal kembali</label>
                                <input type="date" name="date_return" id="date_return" class="form-control" min="{{date('Y-m-d', strtotime('+1 days'))}}">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal req --}}
<div class="modal fade" id="listrequest" tabindex="-1" aria-labelledby="listrequestLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="tabel-wrapper">
                        <table class="table" id="tabelModal">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nama buku</th>
                                    <th>nama user</th>
                                    <th>tanggal pinjam</th>
                                    <th>tanggal kembali</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="dataReq">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('Scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    // onclick add
    $('#addborrowbutton').click(function(){
        // call ajax
        $.ajax({
            url: "{{url('/admin/borowBook/show')}}",
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data){
                console.log(data);
                let user = data.user;
                let book = data.book;
                // looping data
                $('#user_id').html('');
                $('#book_id').html('');
                $.each(user, function(key, value){
                    $('#user_id').append(`
                    <option value="${value.id}">${value.name}</option>
                    `);
                });
                $.each(book, function(key, value){
                    $('#book_id').append(`
                    <option value="${value.id}">${value.title}</option>
                    `);
                });
                $('#addborow').modal('show');
            }
        });
    });
    
    // onclick save
    $('.save').click(function(){
        let id = $(this).data('id');
        // call ajax
        if(confirm('yakin ingin mengembalikan buku?')){
            $.ajax({
                url: "{{url('/admin/borowBook/setBack')}}"+'/'+id,
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    console.log(data);
                    location.reload();
                }
            });
        }
    });
    
    // onclick list request
    $('#listrequestbutton').click(function(){
        // call ajax
        $.ajax({
            url: "{{url('/admin/borowBook/showReq')}}",
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data){
                // looping data
                data = data.data;
                $('#dataReq').html('');
                // jika data kosong
                if(data.length == 0){
                    // hide tabel modal
                    $('#dataReq').html('');
                    $('#dataReq').append(`
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    `);
                } else {
                    $('#dataReq').html('');
                    $.each(data, function(key, value){
                        console.log(value,key);
                        $('#dataReq').append(`
                        <tr>
                            <td>${value.id}</td>
                            <td>${value.book_title}</td>
                            <td>${value.user_name}</td>
                            <td>${value.date_borow}</td>
                            <td>${value.date_return}</td>
                            <td>
                                <a class="approve btn btn-sm" data-id="${value.id}"><i class="bi bi-check-circle-fill"></i></a>
                                <a class="reject btn btn-sm" data-id="${value.id}"><i class="bi bi-x-circle-fill"></i></a>
                            </td>
                        </tr>
                        `);
                    });
                }
                $('#listrequest').modal('show');
            }
        });
    });
    
    // onclick approve
    $('#dataReq').on('click', '.approve', function(){
        let id = $(this).data('id');
        // call ajax
        if(confirm('yakin ingin menyetujui?')){
            $.ajax({
                url: "{{url('/admin/borowBook/approve')}}"+'/'+id,
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    // console.log(data);
                    alert(data.message);
                    location.reload();
                }
            });
        }
    });
    
    // onclick reject
    $('#dataReq').on('click', '.reject', function(){
        let id = $(this).data('id');
        // call ajax
        if(confirm('yakin ingin menolak?')){
            $.ajax({
                url: "{{url('/admin/borowBook/reject')}}"+'/'+id,
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    // console.log(data);
                    alert(data.message);
                    location.reload();
                }
            });
        }
    });

    // onclick setLost
    $('.setLost').click(function(){
        let id = $(this).data('id');
        // call ajax
        if(confirm('yakin ingin Buku ini akan di set hilang?')){
            $.ajax({
                url: "{{url('/admin/borowBook/lost')}}"+'/'+id,
                type: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data){
                    alert(data.message);
                    location.reload();
                }
            });
        }
    });

    
</script>
@endpush
