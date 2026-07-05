@props([
    'value',
])

<button
    type="button"
    x-data="{ copied: false }"
    x-on:click="navigator.clipboard.writeText(@js((string) $value)).then(() => { copied = true; setTimeout(() => copied = false, 1500) })"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-medium text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-100']) }}
>
    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
        <rect x="9" y="9" width="11" height="11" rx="2" />
        <path d="M5 15V5a2 2 0 0 1 2-2h10" />
    </svg>
    <span x-show="!copied">کپی</span>
    <span x-show="copied" x-cloak class="text-emerald-600">کپی شد</span>
</button>
