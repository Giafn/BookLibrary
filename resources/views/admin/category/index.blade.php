@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="/admin/bookList" class="text-dark"><small>ListBook</small></a></li>
        <li><a href="#" class="text-dark"><small>Category</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3><b>List Category</b></h3>
                </div>
                <div class="card-body">
                    <a id="addCategory" class="btn btn-primary mb-3">Add category</a>
                    {{-- table --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th>id</th>
                            <th>nama category</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach ($category as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a class="editCategory btn btn-warning" data-id="{{$item->id}}">Edit</a>
                                    <a href="{{route('admin.category.delete', $item->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal show image --}}
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-body">
                {{-- form add category --}}
                <form action="{{route('admin.category.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Category</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Category">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                {{-- end form add category --}}
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-body">
                {{-- form add category --}}
                <form id="formUpdate" action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Category</label>
                        <input type="text" class="form-control" id="nameEdit" name="name" placeholder="Nama Category">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                {{-- end form add category --}}
            </div>
          </div>
        </div>
    </div>


@endsection
@push('Scripts')
    <script>
        $('#addCategory').click(function(){
            $('#modalAdd').modal('show');
        });

        $('.editCategory').click(function(){
            let id = $(this).data('id');
            $('#formUpdate').attr('action', "{{url('/admin/category/update')}}" + '/' + id);
            $.ajax({
                url: "{{url('/admin/category/edit')}}" + '/' + id,
                type: 'GET',
                success: function(data){
                    $('#nameEdit').val(data.name);
                },
                error: function(data){
                    console.log(data);
                }
            });
            $('#modalEdit').modal('show');
        });
    </script>
@endpush
