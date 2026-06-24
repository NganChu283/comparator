<x-app-layout>
    <section class="hero">
        <div class="hero-inner">
            <div>
                <h1>Tìm kiếm công việc<br><span>mơ ước của bạn</span></h1>
                <p>Khám phá cơ hội việc làm mới từ các công ty hàng đầu, tạo CV online và theo dõi trạng thái ứng tuyển trong một nền tảng duy nhất.</p>

                <form method="GET" action="{{ route('jobs.index') }}" class="search-panel">
                    <div class="search-field">
                        <span class="material-symbols-outlined">search</span>
                        <input name="q" value="{{ request('q') }}" placeholder="Tên công việc, kỹ năng..." />
                    </div>
                    <div class="search-field">
                        <span class="material-symbols-outlined">category</span>
                        <select name="category_id">
                            <option value="">Tất cả ngành nghề</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-field">
                        <span class="material-symbols-outlined">location_on</span>
                        <input name="location" value="{{ request('location') }}" placeholder="Địa điểm" />
                    </div>
                    <div>
                        <button class="button" type="submit">Tìm việc ngay</button>
                    </div>
                </form>

                <div class="actions" style="margin-top:18px;">
                    <span class="muted font-semibold">Từ khóa hot:</span>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Laravel']) }}">Laravel</a>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Remote']) }}">Làm việc từ xa</a>
                    <a class="badge accent" href="{{ route('jobs.index', ['q' => 'Marketing']) }}">Marketing</a>
                </div>

                <div class="hero-kpis">
                    <div class="hero-kpi"><strong>{{ method_exists($jobs, 'total') ? $jobs->total() : $jobs->count() }}+</strong><span class="muted small">việc làm mới</span></div>
                    <div class="hero-kpi"><strong>{{ method_exists($companies, 'total') ? $companies->total() : $companies->count() }}+</strong><span class="muted small">công ty nổi bật</span></div>
                    <div class="hero-kpi"><strong>{{ $categories->count() }}+</strong><span class="muted small">ngành nghề</span></div>
                </div>
            </div>

            <div class="hero-visual">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=1400&q=80" alt="Văn phòng hiện đại">

                <div class="floating-stat bottom">
                    <div class="brand-mark"><span class="material-symbols-outlined">work</span></div>
                    <div>
                        <strong>0+</strong>
                        <div class="muted small">Việc làm mới</div>
                    </div>
                </div>

                <div class="floating-stat top">
                    <div class="brand-mark"><span class="material-symbols-outlined">domain</span></div>
                    <div>
                        <strong>0+</strong>
                        <div class="muted small">Công ty</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="max-width:var(--container); margin: 40px auto 80px;">
        <div class="section-title">
            <h2>Khám phá ngành nghề</h2>
            <a href="{{ route('jobs.index') }}">Tìm theo ngành</a>
        </div>
        <div class="category-strip">
            @foreach ($categories->take(5) as $category)
                <a class="category-card" href="{{ route('jobs.index', ['category_id' => $category->id]) }}">
                    <span class="material-symbols-outlined">category</span>
                    <strong>{{ $category->name }}</strong>
                    <div class="muted small">{{ $category->jobs_count ?? 0 }} việc đang mở</div>
                </a>
            @endforeach
        </div>

        <div class="section-title" style="margin-top:48px;">
            <h2>Việc làm nổi bật</h2>
            <a href="{{ route('jobs.index') }}">Xem tất cả <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></a>
        </div>
        <div class="grid grid-3" style="margin-top:12px;">
            @foreach ($jobs->take(6) as $job)
                <div class="card">
                    <div class="job-card-head">
                        <div class="logo-box"><span class="material-symbols-outlined">work</span></div>
                        <div>
                            <h3 class="job-title">{{ $job->title }}</h3>
                            <div class="job-meta">{{ $job->company->name ?? '' }} • {{ $job->location }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
