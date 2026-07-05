@props([
    'name',
    'label',
    'helper' => null,
    'type' => 'text',
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">
        {{ $label }}
    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'mt-2 block w-full rounded-xl border bg-white px-4 py-3 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:ring-4 '
                . ($errors->has($name)
                    ? 'border-red-400 focus:border-red-500 focus:ring-red-100'
                    : 'border-slate-300 focus:border-blue-500 focus:ring-blue-100'),
        ]) }}
    />

    @if ($helper)
        <p class="mt-2 text-xs text-slate-500">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
