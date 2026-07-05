@props([
    'label',
    'dir' => 'rtl',
    'mono' => false,
    'strong' => false,
])

<div class="flex flex-col gap-1 py-3 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
    <dt class="text-sm font-medium text-slate-500">{{ $label }}</dt>

    <dd
        dir="{{ $dir }}"
        @class([
            'break-all text-slate-900',
            'font-mono tracking-wide' => $mono,
            'text-base font-semibold' => $strong,
            'text-sm' => ! $strong,
        ])
    >
        {{ $slot }}
    </dd>
</div>
