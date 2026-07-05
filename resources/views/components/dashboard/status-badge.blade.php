@props([
    'type' => 'neutral',
])

@php
    $variants = [
        'success' => ['wrap' => 'border-emerald-200 bg-emerald-50 text-emerald-700', 'dot' => 'bg-emerald-500'],
        'error' => ['wrap' => 'border-red-200 bg-red-50 text-red-700', 'dot' => 'bg-red-500'],
        'warning' => ['wrap' => 'border-amber-200 bg-amber-50 text-amber-700', 'dot' => 'bg-amber-500'],
        'neutral' => ['wrap' => 'border-slate-200 bg-slate-50 text-slate-600', 'dot' => 'bg-slate-400'],
    ];
    $variant = $variants[$type] ?? $variants['neutral'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-medium {$variant['wrap']}"]) }}>
    <span class="h-1.5 w-1.5 rounded-full {{ $variant['dot'] }}"></span>
    {{ $slot }}
</span>
