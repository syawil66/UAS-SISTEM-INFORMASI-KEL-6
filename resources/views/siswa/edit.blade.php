@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Data Siswa')

@section('content')


<form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('siswa.form')

</form>

@endsection
