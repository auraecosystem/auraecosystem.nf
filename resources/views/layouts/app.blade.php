<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="layout()"
    x-init="init()"
    :class="{ 'dark': dark }"
>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            @yield('title') • {{ config('app.name', 'Web4') }}
        @else
            {{ config('app.name', 'Web4') }}
        @endif
    </title>

    <meta name="description"
          content="@yield('description','Web4 Developer Platform')">

    <meta name="keywords"
          content="@yield('keywords','AI, Blockchain, Laravel, API, Web4')">

    <meta name="author"
          content="{{ config('app.name') }}">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="theme-color"
          content="#0f172a">

    <meta name="robots"
          content="index,follow">

    <meta property="og:type"
          content="website">

    <meta property="og:title"
          content="@yield('title', config('app.name'))">

    <meta property="og:description"
          content="@yield('description','Modern Web4 Platform')">

    <meta property="og:url"
          content="{{ url()->current() }}">

    <meta property="og:image"
          content="{{ asset('images/og-image.png') }}">

    <meta name="twitter:card"
          content="summary_large_image">

    <meta name="twitter:title"
          content="@yield('title', config('app.name'))">

    <meta name="twitter:description"
          content="@yield('description')">

    <link rel="canonical"
          href="{{ url()->current() }}">

    <link rel="manifest"
          href="{{ asset('manifest.webmanifest') }}">

    <link rel="icon"
          href="{{ asset('favicon.ico') }}">

    <link rel="apple-touch-icon"
          href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('meta')
    @stack('styles')
    @stack('head')

</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">

<a href="#main-content"
   class="sr-only focus:not-sr-only fixed left-4 top-4 z-50 rounded bg-blue-600 px-4 py-2 text-white">
    Skip to content
</a>

<div class="fixed inset-0 -z-10 bg-grid opacity-20"></div>

<header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/80 backdrop-blur">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        <a href="{{ url('/') }}"
           class="text-2xl font-bold text-gradient">
            {{ config('app.name','Web4') }}
        </a>

        <nav class="hidden lg:flex items-center gap-8">

            <a href="{{ url('/') }}" class="hover:text-blue-400">
                Home
            </a>

            <a href="{{ url('/docs') }}" class="hover:text-blue-400">
                Documentation
            </a>

            <a href="{{ url('/api') }}" class="hover:text-blue-400">
                API
            </a>

            <a href="{{ url('/dashboard') }}" class="hover:text-blue-400">
                Dashboard
            </a>

            <a href="{{ url('/downloads') }}" class="hover:text-blue-400">
                Downloads
            </a>

            <a href="{{ url('/blog') }}" class="hover:text-blue-400">
                Blog
            </a>

            <a href="{{ url('/contact') }}" class="hover:text-blue-400">
                Contact
            </a>

        </nav>

        <div class="flex items-center gap-3">

            <div class="hidden xl:block">
                <input
                    type="search"
                    placeholder="Search documentation..."
                    class="w-64 rounded-xl border border-slate-700 bg-slate-900 px-4 py-2 focus:border-blue-500 focus:outline-none">
            </div>

            <button
                @click="toggleTheme()"
                class="rounded-xl border border-slate-700 p-2"
                title="Toggle theme">

                <span x-show="!dark">🌙</span>
                <span x-show="dark">☀️</span>

            </button>

            <button
                @click="mobileOpen = !mobileOpen"
                class="rounded-xl border border-slate-700 p-2 lg:hidden">

                ☰

            </button>
            @auth

                <div class="relative" x-data="{ open: false }">

                    <button
                        @click="open = !open"
                        class="flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-900 px-4 py-2 hover:border-blue-500">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <span class="hidden md:block">
                            {{ auth()->user()->name }}
                        </span>

                        <svg class="h-4 w-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </button>

                    <div
                        x-show="open"
                        @click.away="open=false"
                        x-transition
                        class="absolute right-0 mt-3 w-64 rounded-2xl border border-slate-700 bg-slate-900 shadow-2xl">

                        <div class="border-b border-slate-800 p-4">

                            <p class="font-semibold">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-sm text-slate-400">
                                {{ auth()->user()->email }}
                            </p>

                        </div>

                        <a href="{{ route('dashboard') }}"
                           class="block px-4 py-3 hover:bg-slate-800">
                            Dashboard
                        </a>

                        <a href="{{ url('/profile') }}"
                           class="block px-4 py-3 hover:bg-slate-800">
                            Profile
                        </a>

                        <a href="{{ url('/settings') }}"
                           class="block px-4 py-3 hover:bg-slate-800">
                            Settings
                        </a>

                        <form
                            action="{{ route('logout') }}"
                            method="POST">

                            @csrf

                            <button
                                class="w-full px-4 py-3 text-left hover:bg-red-900">

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            @else

                <a href="{{ route('login') }}"
                   class="rounded-xl bg-slate-800 px-5 py-2 hover:bg-slate-700">

                    Login

                </a>

                @if(Route::has('register'))

                    <a href="{{ route('register') }}"
                       class="rounded-xl bg-blue-600 px-5 py-2 hover:bg-blue-700">

                        Register

                    </a>

                @endif

            @endauth

        </div>

    </div>

    <!-- Mobile Navigation -->

    <div
        x-show="mobileOpen"
        x-transition
        class="border-t border-slate-800 bg-slate-950 lg:hidden">

        <nav class="space-y-2 p-6">

            <a href="/" class="block rounded-lg px-3 py-2 hover:bg-slate-800">Home</a>

            <a href="/docs" class="block rounded-lg px-3 py-2 hover:bg-slate-800">Documentation</a>

            <a href="/api" class="block rounded-lg px-3 py-2 hover:bg-slate-800">API</a>

            <a href="/dashboard" class="block rounded-lg px-3 py-2 hover:bg-slate-800">Dashboard</a>

            <a href="/downloads" class="block rounded-lg px-3 py-2 hover:bg-slate-800">Downloads</a>

            <a href="/contact" class="block rounded-lg px-3 py-2 hover:bg-slate-800">Contact</a>

        </nav>

    </div>

</header>

@if(View::hasSection('hero'))

<section class="relative overflow-hidden">

    @yield('hero')

</section>

@endif

<div class="mx-auto max-w-7xl px-6 pt-8">

    @hasSection('breadcrumbs')

        <nav class="mb-6 text-sm text-slate-400">

            @yield('breadcrumbs')

        </nav>

    @endif

    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-700 bg-green-900/20 p-4 text-green-300">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="mb-6 rounded-xl border border-red-700 bg-red-900/20 p-4 text-red-300">

            {{ session('error') }}

        </div>

    @endif

    @if(session('warning'))

        <div class="mb-6 rounded-xl border border-yellow-700 bg-yellow-900/20 p-4 text-yellow-300">

            {{ session('warning') }}

        </div>

    @endif

    @if(session('info'))

        <div class="mb-6 rounded-xl border border-blue-700 bg-blue-900/20 p-4 text-blue-300">

            {{ session('info') }}

        </div>

    @endif

    <main id="main-content"
          class="min-h-screen">
