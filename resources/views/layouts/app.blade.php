<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tasks for Today Management System">
    <title>@yield('title', 'Tasks for Today') · Tasks for Today</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/system.css') }}">
</head>
<body>
    <div class="app-layout">
        <aside class="app-sidebar">
            <a class="brand system-brand" href="{{ route('home') }}" aria-label="Tasks for Today home">
                <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M8 7.5h16l-1.8 17H9.8L8 7.5Z"/><path d="M12 10V6.7C12 4.7 13.8 3 16 3s4 1.7 4 3.7V10"/><path d="M13 15.5c1.8 2.4 4.2 2.4 6 0"/></svg></span>
                <span class="brand-copy"><strong>Tasks<span>Today</span></strong><small>Management System</small></span>
            </a>
            <div class="sidebar-label">Workspace</div>
            <nav class="sidebar-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home', 'dashboard')])><span class="nav-icon">⌂</span><span>Today</span></a>
                <a href="{{ route('tasks.index') }}" @class(['active' => request()->routeIs('tasks.*')])><span class="nav-icon">✓</span><span>All tasks</span><small>{{ \App\Models\Task::count() }}</small></a>
                <a href="{{ route('profile') }}" @class(['active' => request()->routeIs('profile')])><span class="nav-icon">○</span><span>Profile</span></a>
                <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])><span class="nav-icon">i</span><span>About</span></a>
                @auth
                    <a href="{{ route('customers.index') }}" @class(['active' => request()->routeIs('customers.*')])><span class="nav-icon">♙</span><span>Customers</span><small>{{ \App\Models\Customer::count() }}</small></a>
                    <a href="{{ route('users.index') }}" @class(['active' => request()->routeIs('users.*')])><span class="nav-icon">♙</span><span>Users</span><small>{{ \App\Models\User::count() }}</small></a>
                @endauth
            </nav>
            <div class="sidebar-bloom" aria-hidden="true"><span>✦</span><span>♡</span><span>✿</span></div>
            <div class="sidebar-profile">
                <span class="avatar avatar-small">{{ strtoupper(substr(auth()->user()->full_name ?? 'AN', 0, 2)) }}</span>
                <p><strong>{{ auth()->user()->full_name ?? 'Guest' }}</strong><small>{{ auth()->check() ? 'Signed in' : 'Guest access' }}</small></p>
                @auth
                    <form method="POST" action="{{ route('logout') }}"><button class="profile-menu" type="submit" aria-label="Log out">↪</button>@csrf</form>
                @endauth
            </div>
        </aside>
        <div class="app-workspace">
            <header class="workspace-header">
                <div><span class="workspace-date">{{ now()->format('l, F j') }}</span><h2>@yield('title', 'Dashboard')</h2></div>
                <div class="workspace-actions">
                    @guest
                        <a class="button button-secondary" href="{{ route('login') }}">Log in</a>
                        <a class="button button-primary" href="{{ route('register') }}">Register</a>
                    @else
                        <span class="live-pill"><span></span> Signed in</span>
                    @endguest
                </div>
            </header>
            <main class="workspace-main">@yield('content')</main>
            <footer class="site-footer"><p>Tasks for Today <span>♡</span> Built with Laravel &amp; Blade</p><p>© {{ date('Y') }} · TFA7</p></footer>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
