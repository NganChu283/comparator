<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('app.css') }}">
    </head>
    <body>
        <div class="auth-page">
            <div class="auth-visual">
                <a class="brand" href="{{ route('home') }}"><span class="brand-mark"><span class="material-symbols-outlined">work</span></span>TopCV Mini</a>
                <h1>Tìm việc, tạo CV và quản lý tuyển dụng trong một hệ thống.</h1>
                <p>Giao diện thống nhất cho ứng viên, nhà tuyển dụng và quản trị viên.</p>
                <div class="hero-kpis">
                    <div class="hero-kpi"><strong>CV</strong><span class="muted small">Tạo hồ sơ online</span></div>
                    <div class="hero-kpi"><strong>Việc</strong><span class="muted small">Ứng tuyển nhanh</span></div>
                    <div class="hero-kpi"><strong>Quản trị</strong><span class="muted small">Quản lý dữ liệu</span></div>
                </div>
            </div>
            <div class="card auth-card">
                {{ $slot }}
            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>
