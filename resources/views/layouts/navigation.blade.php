<nav class="topbar">
    <div class="nav">
        <div class="nav-links nav-primary">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark"><span class="material-symbols-outlined">work</span></span>TopCV Mini</a>
            <a class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}" href="{{ route('jobs.index') }}"><span class="material-symbols-outlined">work</span>Việc làm</a>
            <a class="{{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}"><span class="material-symbols-outlined">domain</span>Công ty</a>
            @auth
                <a class="{{ request()->routeIs('*.dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="material-symbols-outlined">dashboard</span>Bảng điều khiển</a>
                @if (auth()->user()->role === 'candidate')
                    <a class="{{ request()->routeIs('candidate.cvs.*') ? 'active' : '' }}" href="{{ route('candidate.cvs.index') }}">CV của tôi</a>
                    <a class="{{ request()->routeIs('candidate.applications.*') ? 'active' : '' }}" href="{{ route('candidate.applications.index') }}">Đã ứng tuyển</a>
                    <a class="{{ request()->routeIs('candidate.saved-jobs.*') ? 'active' : '' }}" href="{{ route('candidate.saved-jobs.index') }}">Việc đã lưu</a>
                @elseif (auth()->user()->role === 'employer')
                    <a class="{{ request()->routeIs('employer.company.*') ? 'active' : '' }}" href="{{ route('employer.company.index') }}">Công ty</a>
                    <a class="{{ request()->routeIs('employer.jobs.*') ? 'active' : '' }}" href="{{ route('employer.jobs.index') }}">Tin tuyển dụng</a>
                @elseif (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}">Người dùng</a>
                    <a href="{{ route('admin.jobs.index') }}">Tin tuyển dụng</a>
                    <a href="{{ route('admin.categories.index') }}">Ngành nghề</a>
                @endif
            @endauth
        </div>
        <div class="nav-links">
            @auth
                <span class="user-pill"><span class="material-symbols-outlined">account_circle</span>{{ auth()->user()->name }}</span>
                <a href="{{ route('profile.edit') }}">Hồ sơ</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="link-button" type="submit">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a class="button bright" href="{{ route('register') }}">Đăng ký</a>
            @endauth
        </div>
    </div>
</nav>
