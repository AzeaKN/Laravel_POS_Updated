@extends('layouts.app')

@section('title', 'Customer Accounts')

@section('content')
    <section class="page-hero table-hero"><div class="page-shell page-title-row">
        <div><div class="breadcrumbs"><a href="{{ route('home') }}">Home</a><span>/</span><strong>Customers</strong></div><h1>Customer accounts</h1><p>View and manage the lovely people who keep your business growing.</p></div>
        <span class="count-chip"><strong>{{ count($customers) }}</strong> customer records</span>
    </div></section>

    <section class="page-shell table-section">
        <div class="stats-grid">
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><path d="M16 20v-1.7c0-2-1.8-3.8-4-3.8H6c-2.2 0-4 1.8-4 3.8V20M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-2a3 3 0 0 1 0 6m2 5v-1.7c0-1.5-.8-2.8-2-3.4"/></svg></span><p>Total customers<strong>{{ count($customers) }}</strong><small>Database records</small></p></div>
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><path d="m4 14 5-5 4 4 7-8"/><path d="M15 5h5v5"/></svg></span><p>Total orders<strong>{{ collect($customers)->sum('orders') }}</strong><small class="positive">↑ Active history</small></p></div>
            <div class="stat-card"><span class="stat-icon"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h3"/></svg></span><p>Customer value<strong>₱{{ number_format(collect($customers)->sum('spent'), 2) }}</strong><small>Across all records</small></p></div>
        </div>

        <div class="data-card">
            <div class="table-toolbar"><div><h2>Customer directory</h2><p>Customer information retrieved from the database.</p></div><label class="search-box"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input type="search" placeholder="Search customers" aria-label="Search customers"></label></div>
            <div class="table-wrap"><table>
                <thead><tr><th>Customer</th><th>Contact</th><th>Joined</th><th>Orders</th><th>Total spent</th><th>Status</th></tr></thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td><div class="person-cell"><span class="avatar">{{ (strtoupper(collect(preg_split('/\s+/', $customer->full_name))->map(fn ($part) => substr($part, 0, 1))->take(2)->implode(''))) }}</span><p><strong>{{ $customer->full_name }}</strong><small>{{ ('CUS-' . (1000 + $customer->id)) }}</small></p></div></td>
                        <td><div class="contact-cell"><span>{{ $customer->email }}</span><small>{{ $customer->phone }}</small></div></td>
                        <td>{{ $customer->joined?->format('M d, Y') }}</td><td><strong>{{ $customer->orders }}</strong></td><td><strong>₱{{ number_format($customer->spent, 2) }}</strong></td>
                        <td><span @class(['status-pill', 'inactive' => $customer->status === 'Inactive'])><span></span>{{ $customer->status }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table></div>
            <div class="table-footer"><span>Showing all {{ count($customers) }} customers</span><span class="pagination"><button disabled>‹</button><button class="current">1</button><button disabled>›</button></span></div>
        </div>
    </section>
@endsection
