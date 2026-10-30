@extends('layouts.app')

@section('title', 'About')

@section('content')
    <section class="page-hero compact-hero"><div class="page-shell centered-copy"><span class="eyebrow"><span class="eyebrow-dot"></span> About the project</span><h1>Tasks for Today <span>Management System.</span></h1><p>A Laravel rebuild of the TSA1 task management system.</p></div></section>
    <section class="section page-shell">
        <div class="about-copy"><span class="kicker">DEVELOPER</span><h2>Built by AZ.</h2><p>This application was developed as a Laravel and Blade implementation of TSA1. It demonstrates migrations, Eloquent models, seeders, controllers, routes, and database-backed views.</p><div class="principle-list"><div><span>01</span><p><strong>Welcome</strong>Shows only tasks scheduled for today.</p></div><div><span>02</span><p><strong>Task List</strong>Shows every task ordered by date.</p></div><div><span>03</span><p><strong>Profile</strong>Displays the single seeded user record.</p></div></div></div>
    </section>
@endsection
