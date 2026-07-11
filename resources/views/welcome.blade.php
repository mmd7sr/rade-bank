<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="سامانه خدمات مالی و بانکی؛ تبدیل کارت و حساب به شبا، استعلام اطلاعات بانکی و سایر ابزارهای مالی."
    >

    <title>{{ config('app.name', 'راد') }} | خدمات مالی و بانکی</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">

    {{-- Header --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            {{-- Logo --}}
            <a
                href="{{ url('/') }}"
                class="group flex items-center gap-3"
                aria-label="صفحه اصلی"
            >
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 shadow-lg shadow-blue-600/20 transition duration-300 group-hover:-translate-y-0.5">
                    <svg
                        class="h-6 w-6 text-white"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 10.5 12 4l9 6.5M5.5 9.5V19m4-9.5V19m5-9.5V19m4-9.5V19M3 20h18"
                        />
                    </svg>
                </div>

                <div>
                    <div class="text-lg font-black tracking-tight text-slate-900">
                        {{ config('app.name', 'راد') }}
                    </div>

                    <div class="text-xs font-medium text-slate-500">
                        خدمات مالی و بانکی
                    </div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden items-center gap-8 lg:flex" aria-label="منوی اصلی">
                <a
                    href="#services"
                    class="text-sm font-semibold text-slate-600 transition hover:text-blue-700"
                >
                    خدمات
                </a>

                <a
                    href="#features"
                    class="text-sm font-semibold text-slate-600 transition hover:text-blue-700"
                >
                    مزایای سامانه
                </a>

                <a
                    href="#how-it-works"
                    class="text-sm font-semibold text-slate-600 transition hover:text-blue-700"
                >
                    راهنمای استفاده
                </a>

                <a
                    href="#faq"
                    class="text-sm font-semibold text-slate-600 transition hover:text-blue-700"
                >
                    سؤالات متداول
                </a>
            </nav>

            {{-- Authentication --}}
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-bold text-white shadow-md shadow-blue-700/20 transition hover:bg-blue-800"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 13h6V4H4v9Zm10 7h6v-9h-6v9ZM4 20h6v-3H4v3Zm10-13h6V4h-6v3Z"
                            />
                        </svg>

                        پنل کاربری
                    </a>
                @else
                    @if (Route::has('login'))
                        <a
                            href="{{ route('login') }}"
                            class="hidden rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 transition hover:bg-slate-100 sm:inline-flex"
                        >
                            ورود
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-bold text-white shadow-md shadow-blue-700/20 transition hover:bg-blue-800"
                        >
                            ثبت‌نام
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section class="relative overflow-hidden border-b border-slate-200 bg-white">
            <div class="absolute inset-0 -z-10">
                <div class="absolute -right-40 -top-40 h-[34rem] w-[34rem] rounded-full bg-blue-100/70 blur-3xl"></div>
                <div class="absolute -bottom-48 -left-32 h-[32rem] w-[32rem] rounded-full bg-indigo-100/70 blur-3xl"></div>
            </div>

            <div class="mx-auto grid min-h-[680px] max-w-7xl items-center gap-14 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">

                {{-- Hero Content --}}
                <div class="text-center lg:text-right">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-500 opacity-50"></span>
                            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-blue-600"></span>
                        </span>

                        سامانه یکپارچه ابزارهای بانکی
                    </div>

                    <h1 class="text-4xl font-black leading-[1.45] tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                        خدمات بانکی،

                        <span class="relative whitespace-nowrap text-blue-700">
                            ساده و سریع
                            <span class="absolute -bottom-2 right-0 h-1.5 w-full rounded-full bg-blue-200"></span>
                        </span>
                    </h1>

                    <p class="mx-auto mt-8 max-w-2xl text-base font-medium leading-8 text-slate-600 sm:text-lg lg:mx-0">
                        با سامانه {{ config('app.name', 'راد') }} به ابزارهای کاربردی
                        مالی و بانکی دسترسی داشته باشید؛ از تبدیل شماره کارت و حساب
                        به شبا تا استعلام اطلاعات بانکی، همه در یک محیط امن و حرفه‌ای.
                    </p>

                    <div class="mt-10 flex flex-col items-stretch justify-center gap-3 sm:flex-row sm:items-center lg:justify-start">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-700 px-7 py-4 text-base font-extrabold text-white shadow-xl shadow-blue-700/20 transition hover:-translate-y-0.5 hover:bg-blue-800"
                            >
                                ورود به پنل کاربری

                                <svg
                                    class="h-5 w-5 rotate-180"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m9 18 6-6-6-6"
                                    />
                                </svg>
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-700 px-7 py-4 text-base font-extrabold text-white shadow-xl shadow-blue-700/20 transition hover:-translate-y-0.5 hover:bg-blue-800"
                                >
                                    شروع رایگان

                                    <svg
                                        class="h-5 w-5 rotate-180"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m9 18 6-6-6-6"
                                        />
                                    </svg>
                                </a>
                            @endif
                        @endauth

                        <a
                            href="#services"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-7 py-4 text-base font-extrabold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700"
                        >
                            مشاهده خدمات
                        </a>
                    </div>

                    <div class="mt-10 flex flex-wrap items-center justify-center gap-x-6 gap-y-3 text-sm font-semibold text-slate-500 lg:justify-start">
                        <div class="flex items-center gap-2">
                            <svg
                                class="h-5 w-5 text-emerald-600"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                            پاسخ‌گویی سریع
                        </div>

                        <div class="flex items-center gap-2">
                            <svg
                                class="h-5 w-5 text-emerald-600"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                            محافظت از اطلاعات
                        </div>

                        <div class="flex items-center gap-2">
                            <svg
                                class="h-5 w-5 text-emerald-600"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                            دسترسی شبانه‌روزی
                        </div>
                    </div>
                </div>

                {{-- Hero Visual --}}
                <div class="relative mx-auto w-full max-w-lg">
                    <div class="absolute -inset-8 rounded-[3rem] bg-gradient-to-br from-blue-100 to-indigo-100 opacity-80 blur-2xl"></div>

                    <div class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white p-5 shadow-2xl shadow-slate-300/50 sm:p-7">
                        <div class="mb-6 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-slate-500">
                                    پنل خدمات بانکی
                                </p>

                                <h2 class="mt-1 text-xl font-black text-slate-900">
                                    به {{ config('app.name', 'راد') }} خوش آمدید
                                </h2>
                            </div>

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-700">
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-3-3v6m9-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>
                            </div>
                        </div>

                        {{-- Bank Card --}}
                        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-950 p-6 text-white shadow-xl shadow-blue-900/20">
                            <div class="absolute -left-14 -top-16 h-48 w-48 rounded-full border-[24px] border-white/5"></div>
                            <div class="absolute -bottom-20 -right-14 h-56 w-56 rounded-full border-[28px] border-white/5"></div>

                            <div class="relative">
                                <div class="flex items-center justify-between">
                                    <div class="flex h-11 w-14 items-center justify-center rounded-lg bg-gradient-to-br from-amber-200 to-amber-500">
                                        <div class="h-7 w-9 rounded border border-amber-700/30"></div>
                                    </div>

                                    <svg
                                        class="h-8 w-8 text-white/80"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            d="M7 8.5a5 5 0 0 1 0 7M10 6a8 8 0 0 1 0 12M13 3.5a11 11 0 0 1 0 17"
                                        />
                                    </svg>
                                </div>

                                <div
                                    dir="ltr"
                                    class="mt-8 text-center font-mono text-xl font-bold tracking-[0.2em] sm:text-2xl"
                                >
                                    6037&nbsp; **** &nbsp;****&nbsp; 1234
                                </div>

                                <div class="mt-7 flex items-end justify-between">
                                    <div>
                                        <div class="text-xs text-blue-200">
                                            نام دارنده کارت
                                        </div>

                                        <div class="mt-1 text-sm font-bold">
                                            کاربر سامانه
                                        </div>
                                    </div>

                                    <div class="text-left">
                                        <div class="text-xs text-blue-200">
                                            سامانه بانکی
                                        </div>

                                        <div class="mt-1 text-lg font-black">
                                            {{ config('app.name', 'راد') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mini Services --}}
                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m7 7 10 10M17 7v10H7"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="text-xs font-semibold text-slate-500">
                                            سرویس
                                        </div>

                                        <div class="mt-1 text-sm font-extrabold text-slate-800">
                                            کارت به شبا
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl 