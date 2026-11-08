@extends('layouts.app')

@section('title', 'Add User')

@section('content')
    <section class="page-hero table-hero"><div class="page-shell page-title-row">
        <div><div class="breadcrumbs"><a href="{{ route('users.index') }}">Users</a><span>/</span><strong>Add user</strong></div><h1>Add user</h1><p>Create a new staff account.</p></div>
    </div></section>
    <section class="page-shell form-section"><div class="data-card form-card">
        @if ($errors->any())<div class="form-alert">Please correct the highlighted fields.</div>@endif
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            @php($submitLabel = 'Create user')
            @include('users.form')
        </form>
    </div></section>
@endsection
