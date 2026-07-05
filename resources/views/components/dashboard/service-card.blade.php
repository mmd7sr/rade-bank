@props([
    'title',
    'description' => null,
    'href' => '#',
])

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => 'group flex items-start gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-blue-300 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100']) }}
>
    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700 transition group-hover:bg-blue-100">
        {{ $icon ?? '' }}
    </span>

    <span class="min-w-0">
        <span class="block font-semibold text-slate-900">{{ $title }}</span>
        @if ($description)
            <span class="mt-1 block text-sm leading-6 text-slate-500">{{ $description }}</span>
        @endif
    </span>
</a>
