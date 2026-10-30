@extends('layouts.app')

@section('title', 'Tasks for Today')

@section('content')
    <section class="page-hero table-hero">
        <div class="page-shell page-title-row">
            <div>
                <span class="kicker">WELCOME</span>
                <h1>Tasks for today</h1>
                <p>{{ now()->format('l, F j, Y') }} · Focus on what needs to be done.</p>
            </div>
            <span class="count-chip"><strong>{{ $tasks->count() }}</strong> today</span>
        </div>
    </section>

    <section class="page-shell table-section">
        <div class="data-card">
            <div class="table-toolbar">
                <div><h2>Today’s task list</h2><p>Only tasks scheduled for today are shown here.</p></div>
                <a class="button button-primary" href="{{ route('tasks.index') }}">View all tasks</a>
            </div>
            <div class="task-list">
                @forelse ($tasks as $task)
                    <article class="feature-card">
                        <span class="feature-icon">{{ $task->status === 'completed' ? '✓' : '○' }}</span>
                        <div><h3>{{ $task->title }}</h3><p>{{ ucfirst($task->status) }} · {{ $task->task_date->format('M d, Y') }}</p></div>
                    </article>
                @empty
                    <p>No tasks are scheduled for today.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
