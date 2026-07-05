@props([
    'type' => 'info',
])

@php
    $variants = [
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
        'error' => 'border-red-200 bg-red-50 text-red-700',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800',
        'info' => 'border-slate-200 bg-slate-50 text-slate-700',
    ];
    $classes = $variants[$type] ?? $variants['info'];
@endphp

<div {{ $attributes->merge(['class' => "rounded-xl border px-4 py-3 text-sm $classes"]) }} role="alert">
    {{ $slot }}
</div>
