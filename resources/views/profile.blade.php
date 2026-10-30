@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <section class="page-hero compact-hero"><div class="page-shell centered-copy"><span class="eyebrow"><span class="eyebrow-dot"></span> Your profile</span><h1>About the person using <span>Tasks for Today.</span></h1><p>Your account details are stored with Laravel’s User model.</p></div></section>
    <section class="section page-shell">
        <div class="about-grid">
            <div class="about-copy"><span class="kicker">PROFILE DETAILS</span><h2>{{ $user->full_name }}</h2><p>This is the single user record provided by the TSA1 seed data.</p></div>
            <div class="data-card"><div class="table-toolbar"><div><h2>Account information</h2></div></div><div class="contact-cell"><span><strong>Username:</strong> {{ $user->username }}</span><span><strong>Full name:</strong> {{ $user->full_name }}</span><span><strong>Email:</strong> {{ $user->email }}</span></div></div>
        </div>
    </section>
@endsection
