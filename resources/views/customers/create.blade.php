@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
    <section class="page-hero table-hero"><div class="page-shell page-title-row">
        <div><div class="breadcrumbs"><a href="{{ route('customers.index') }}">Customers</a><span>/</span><strong>Add customer</strong></div><h1>Add customer</h1><p>Create a new customer account.</p></div>
    </div></section>
    <section class="page-shell form-section"><div class="data-card form-card">
        @if ($errors->any())<div class="form-alert">Please correct the highlighted fields.</div>@endif
        <form method="POST" action="{{ route('customers.store') }}">
            @csrf
            @php($submitLabel = 'Create customer')
            @include('customers.form')
        </form>
    </div></section>
@endsection
