@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-title', 'Tambah Siswa')

@section('content')

<form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('siswa.form')
</form>

@endsection
