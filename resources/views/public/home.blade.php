<x-app-layout>
    <section class="hero full-bleed">
        <div class="hero-inner">
            <div>
                <h1>Tìm kiếm công việc<br><span>mơ ước của bạn</span></h1>
                <p>Khám phá cơ hội việc làm mới từ các công ty hàng đầu, tạo CV online và theo dõi trạng thái ứng tuyển trong một nền tảng duy nhất.</p>
                <form class="search-panel" method="GET" action="{{ route('jobs.index') }}">
                    <div class="search-field">
                        <span class="material-symbols-outlined">search</span>
                        <input name="q" placeholder="Tên công việc, kỹ năng, công ty...">
                    </div>
                    <div class="search-field">
                        <span class="material-symbols-outlined">category</span>
                        <select name="category_id">
                            <option value="">Tất cả ngành nghề</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-field">
                        <span class="material-symbols-outlined">location_on</span>
                        <input name="location" placeholder="Địa điểm">
                    </div>
                    <button class="button bright" type="submit">Tìm việc ngay</button>
                </form>
                <div class="actions" style="margin-top: 24px;">
                    <span class="muted font-semibold">Từ khóa hot:</span>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Laravel']) }}">Laravel</a>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Remote']) }}">Làm việc từ xa</a>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Marketing']) }}">Marketing</a>
                </div>
                <div class="hero-kpis">
                    <div class="hero-kpi"><strong>{{ $jobs->count() }}+</strong><span class="muted small">việc làm mới</span></div>
                    <div class="hero-kpi"><strong>{{ $companies->count() }}+</strong><span class="muted small">công ty nổi bật</span></div>
                    <div class="hero-kpi"><strong>{{ $categories->count() }}+</strong><span class="muted small">ngành nghề</span></div>
                </div>
            </div>
            <div class="hero-visual">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=1200&q=80" alt="Văn phòng hiện đại">
                <div class="floating-stat bottom">
                    <span class="brand-mark"><span class="material-symbols-outlined">work</span></span>
                    <div><strong>{{ $jobs->count() }}+</strong><div class="muted small">Việc làm mới</div></div>
                </div>
                <div class="floating-stat top">
                    <span class="brand-mark"><span class="material-symbols-outlined">domain</span></span>
                    <div><strong>{{ $companies->count() }}+</strong><div class="muted small">Công ty</div></div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-title">
        <h2>Khám phá ngành nghề</h2>
        <a href="{{ route('jobs.index') }}">Tìm theo ngành</a>
    </div>
    <div class="category-strip">
        @foreach ($categories->take(5) as $category)
            <a class="category-card" href="{{ route('jobs.index', ['category_id' => $category->id]) }}">
                <span class="material-symbols-outlined">category</span>
                <strong>{{ $category->name }}</strong>
                <div class="muted small">{{ $category->jobs_count }} việc đang mở</div>
            </a>
        @endforeach
    </div>

    <div class="section-title">
        <h2>Việc làm nổi bật</h2>
        <a href="{{ route('jobs.index') }}">Xem tất cả <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></a>
    </div>
    <div class="actions" style="margin-bottom: 16px;">
        <span class="badge primary">Gợi ý cho bạn</span>
        <span class="badge">Việc làm IT</span>
        <span class="badge">Làm việc từ xa</span>
        <span class="badge">Thực tập sinh</span>
    </div>
    <div class="grid grid-3">
        @foreach ($jobs as $job)
            @include('partials.job-card', ['job' => $job])
        @endforeach
    </div>

    <div class="section-title">
        <h2>Công ty nổi bật</h2>
        <a href="{{ route('companies.index') }}">Xem tất cả</a>
    </div>
    <div class="grid grid-3">
        @foreach ($companies as $company)
            <div class="card">
                <div class="logo-box" style="margin-bottom: 12px;"><span class="material-symbols-outlined">domain</span></div>
                <h3><a href="{{ route('companies.show', $company) }}">{{ $company->name }}</a></h3>
                <p class="muted">{{ $company->address }}</p>
                <p><span class="badge primary">{{ $company->jobs_count }} tin tuyển dụng</span></p>
            </div>
        @endforeach
    </div>

    <div class="section-title">
        <h2>CareerLink hỗ trợ bạn như thế nào?</h2>
    </div>
    <section class="feature-band">
        <div class="grid grid-3">
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">description</span></span>
                <div>
                    <h3>Tạo CV online chi tiết</h3>
                    <p class="muted">Lưu học vấn, kinh nghiệm, kỹ năng, dự án hoặc upload CV PDF có sẵn.</p>
                </div>
            </div>
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">send</span></span>
                <div>
                    <h3>Ứng tuyển nhanh</h3>
                    <p class="muted">Chọn CV phù hợp, gửi thư giới thiệu và theo dõi trạng thái xử lý.</p>
                </div>
            </div>
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">analytics</span></span>
                <div>
                    <h3>Quản lý tuyển dụng</h3>
                    <p class="muted">Nhà tuyển dụng đăng tin, xem CV ứng viên và cập nhật trạng thái hồ sơ.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
