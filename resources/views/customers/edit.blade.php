@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <section class="page-hero table-hero"><div class="page-shell page-title-row">
        <div><div class="breadcrumbs"><a href="{{ route('customers.index') }}">Customers</a><span>/</span><strong>Edit customer</strong></div><h1>Edit customer</h1><p>Update {{ $customer->full_name }}'s account details.</p></div>
    </div></section>
    <section class="page-shell form-section"><div class="data-card form-card">
        @if ($errors->any())<div class="form-alert">Please correct the highlighted fields.</div>@endif
        <form method="POST" action="{{ route('customers.update', $customer) }}">
            @csrf
            @method('PUT')
            @php($submitLabel = 'Save changes')
            @include('customers.form')
        </form>
    </div></section>
@endsection
