@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <section class="page-hero table-hero">
        <div class="page-shell page-title-row">
            <div><span class="kicker">TASK MANAGEMENT</span><h1>Task list</h1><p>Every task, ordered by its scheduled date.</p></div>
            <span class="count-chip"><strong>{{ $tasks->count() }}</strong> tasks</span>
        </div>
    </section>
    <section class="page-shell table-section">
        <div class="data-card">
            <div class="table-toolbar"><div><h2>All tasks</h2><p>Review pending and completed work across all dates.</p></div></div>
            <div class="table-wrap"><table>
                <thead><tr><th>Title</th><th>Status</th><th>Task date</th></tr></thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr><td><strong>{{ $task->title }}</strong></td><td><span class="status-pill {{ $task->status === 'completed' ? '' : 'inactive' }}"><span></span>{{ ucfirst($task->status) }}</span></td><td>{{ $task->task_date->format('M d, Y') }}</td></tr>
                    @endforeach
                </tbody>
            </table></div>
        </div>
    </section>
@endsection
