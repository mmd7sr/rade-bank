@props([
    'title' => null,
    'subtitle' => null,
])

<section {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8']) }}>
    @if ($title)
        <header class="mb-6">
            <h2 class="text-lg font-semibold text-slate-900">{{ $title }}</h2>

            @if ($subtitle)
                <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
            @endif
        </header>
    @endif

    {{ $slot }}
</section>
