@extends('layouts.app')

@section('title', 'User Accounts')

@section('content')
    <section class="page-hero table-hero"><div class="page-shell page-title-row">
        <div><div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>/</span><strong>Users</strong></div><h1>User accounts</h1><p>Keep your staff access and responsibilities easy to review.</p></div>
        <span class="count-chip"><strong>{{ count($users) }}</strong> team members</span>
    </div></section>

    <section class="page-shell table-section">
        <div class="stats-grid">
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span><p>Total users<strong>{{ count($users) }}</strong><small>Across the workspace</small></p></div>
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><path d="M4 5.5 12 2l8 3.5v6c0 4.8-3.4 8.5-8 10.5-4.6-2-8-5.7-8-10.5v-6Z"/><path d="m9 12 2 2 4-4"/></svg></span><p>Active accounts<strong>{{ collect($users)->where('status', 'Active')->count() }}</strong><small class="positive">Secure and enabled</small></p></div>
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><p>Roles assigned<strong>{{ collect($users)->unique('role')->count() }}</strong><small>Defined responsibilities</small></p></div>
        </div>

        <div class="data-card">
            <div class="table-toolbar"><div><h2>Team directory</h2><p>User information retrieved from the database.</p></div><label class="search-box"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input type="search" placeholder="Search team" aria-label="Search team"></label></div>
            <div class="table-wrap"><table>
                <thead><tr><th>Team member</th><th>Email address</th><th>Role</th><th>Last active</th><th>Status</th></tr></thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><div class="person-cell"><span class="avatar">{{ (strtoupper(collect(preg_split('/\s+/', $user->full_name))->map(fn ($part) => substr($part, 0, 1))->take(2)->implode(''))) }}</span><p><strong>{{ $user->full_name }}</strong><small>{{ ('USR-' . str_pad($user->id, 3, '0', STR_PAD_LEFT)) }}</small></p></div></td>
                        <td>{{ $user->email }}</td><td><span class="role-pill">{{ $user->role }}</span></td><td>{{ $user->last_active }}</td>
                        <td><span @class(['status-pill', 'away' => $user->status === 'Away', 'inactive' => $user->status === 'Inactive'])><span></span>{{ $user->status }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table></div>
            <div class="table-footer"><span>Showing all {{ count($users) }} users</span><span class="pagination"><button disabled>‹</button><button class="current">1</button><button disabled>›</button></span></div>
        </div>
    </section>
@endsection
