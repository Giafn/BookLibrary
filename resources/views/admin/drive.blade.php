@extends('layouts-admin.app')

@section('content')
    <ul class="breadcrumb-white breadcrumb">
        <li><a href="/admin" class="text-dark"><small>Home</small></a></li>
        <li><a href="/admin/bookList" class="text-dark"><small>ListBook</small></a></li>
        <li><a href="#" class="text-dark"><small>Drive</small></a></li>
    </ul>
    <div class="row ps-3">
        <div class="col">
            to edit access image please click <a target="_blank" href="https://drive.google.com/drive/folders/1TTmvnek2Be4Pelf4VUQKm8y8zmokUtbN?usp=sharing">here</a>
            <iframe src="https://drive.google.com/embeddedfolderview?id=1TTmvnek2Be4Pelf4VUQKm8y8zmokUtbN#grid" style="width:100%; height:600px; border:0;"></iframe>
        </div>
    </div>
@endsection
@push('Scripts')
<script>
</script>
@endpush
