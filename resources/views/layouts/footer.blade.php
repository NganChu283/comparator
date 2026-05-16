<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark"><span class="material-symbols-outlined">work</span></span>TopCV Mini</a>
            <p>Nền tảng tuyển dụng mini giúp ứng viên tạo CV, ứng tuyển và theo dõi hồ sơ; nhà tuyển dụng đăng tin và quản lý ứng viên.</p>
        </div>
        <div>
            <h3>Ứng viên</h3>
            <a href="{{ route('jobs.index') }}">Tìm việc làm</a>
            <a href="{{ route('register') }}">Tạo tài khoản</a>
            @auth
                @if (auth()->user()->role === 'candidate')
                    <a href="{{ route('candidate.cvs.index') }}">Quản lý CV</a>
                @endif
            @endauth
        </div>
        <div>
            <h3>Nhà tuyển dụng</h3>
            <a href="{{ route('register') }}">Đăng ký tuyển dụng</a>
            @auth
                @if (auth()->user()->role === 'employer')
                    <a href="{{ route('employer.jobs.index') }}">Quản lý tin đăng</a>
                @endif
            @endauth
            <a href="{{ route('companies.index') }}">Danh sách công ty</a>
        </div>
        <div>
            <h3>Hệ thống</h3>
            <span>Email: support@careerlink.test</span>
            <span>Hotline: 1900 0000</span>
            <span>© {{ date('Y') }} CareerLink</span>
        </div>
    </div>
</footer>
