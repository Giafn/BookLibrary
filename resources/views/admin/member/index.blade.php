@extends('layouts-admin.app')

@section('content')
<ul class="breadcrumb-white breadcrumb">
    <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
    <li><a href="#" class="text-dark"><small>Member</small></a></li>
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
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$error}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <h3><b>Member List</b></h3>
            </div>
            <div class="card-body">
                <a id="addMember" class="btn btn-primary mb-3">Add Member</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">no</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">joined at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $m)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$m->name}}</td>
                            <td>{{$m->email}}</td>
                            <td>{{$m->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="editBtn btn btn-sm btn-warning me-1" data-id="{{$m->id}}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    {{-- btn delete --}}
                                    <button class="deleteBtn btn btn-sm btn-danger" data-id="{{$m->id}}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                    {{-- form delete --}}
                                    <form id="form-{{$m->id}}" action="{{route('admin.member.delete', $m->id)}}" method="get">
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- modal add member --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                {{-- form --}}
                <form action="{{route('admin.member.add')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Member Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Member Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal edit member --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                {{-- form --}}
                <form action="{{route('admin.member.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="idedit">
                    <div class="mb-3">
                        <label for="name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="nameedit" name="name" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Member Email</label>
                        <input type="email" class="form-control" id="emailedit" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Member Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@push('Scripts')
<script>
    $(document).ready(function(){
        // data table
        $('.table').DataTable();
        $('#addMember').click(function(){
            $('#modalAdd').modal('show');
        });
        // edit
        $('.editBtn').click(function(){
            let id = $(this).data('id');
            $.ajax({
                url: "{{url('/admin/member/edit')}}"+'/'+id,
                type: 'GET',
                success: function(data){
                    $('#idedit').val(data.id);
                    $('#nameedit').val(data.name);
                    $('#emailedit').val(data.email);
                    $('#modalEdit').modal('show');
                }
            });
        });
        // delete
        $('.deleteBtn').click(function(){
            let id = $(this).data('id');
            if (confirm('Are you sure?')) {
                $('#form-'+id).submit();
            }
        });
    });
</script>
@endpush
